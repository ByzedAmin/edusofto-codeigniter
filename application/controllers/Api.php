<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends MY_Controller
{
    private $ci;
    public $api_config;


    function __construct()
    {
        parent::__construct();
        $this->ci = &get_instance();
        $this->load->model('userrole_model');
        $this->load->model('fees_model');
        $this->load->model('sms_model');
    }

    public function initialize($branchID = '')
    {
        $this->api_config = $this->ci->db->select('bkash_pay_bill_username,bkash_pay_bill_password,bkash_pay_bill_status')->where('branch_id', 1)->get('payment_config')->row_array();
        if (empty($this->api_config)) {
            $this->api_config = ['bkash_pay_bill_username' => '', 'bkash_pay_bill_password' => '', 'bkash_pay_bill_status' => 0];
        }
    }

    public function bkash_query_bill()
    {
        $this->initialize();
        $this->output->set_content_type('application/json');

        if ($_POST){
            $userName = $this->input->post('UserName'); // required
            $password = $this->input->post('Password'); // required
            $accountNo = $this->input->post('AccNo'); // Optional
            $meterNo = $this->input->post('MasterNo'); // Optional
            $customerNo = $this->input->post('CustomerNo'); // Optional
            $billNo = $this->input->post('BillNo'); // Optional
            $refId = $this->input->post('RefID'); // Optional
            $billMonth = $this->input->post('BillMonth'); // Required
            $amount = $this->input->post('Amount'); // Optional


            // Check if mandatory fields are empty
            if (empty($userName) || empty($password) || empty($billMonth)
                || empty($accountNo) && empty($meterNo) && empty($customerNo) && empty($billNo) && empty($refId)){
                $this->output->set_output(json_encode([
                    "ErrorCode" => 406,
                    "ErrorMsg" => "Mandatory Field Missing",
                ]));
                return;
            }

            // Check if bkash credentials are empty
            if (empty($this->api_config['bkash_pay_bill_username']) || empty($this->api_config['bkash_pay_bill_password'])){
                $this->output->set_output(json_encode([
                    "ErrorCode" => 404,
                    "ErrorMsg" => "Bkash Credentials Not Found",
                ]));
                return;
            }

            // Check Authentication
            if ($userName != $this->api_config['bkash_pay_bill_username'] || $password != $this->api_config['bkash_pay_bill_password']){
                $this->output->set_output(json_encode([
                    "ErrorCode" => 403,
                    "ErrorMsg" => "Authentication Failed",
                ]));
                return;
            }

            // Get Invoice Information
            $studentId = $accountNo ?? $meterNo ?? $customerNo ?? $billNo ?? $refId;
            $invoiceStatus = $this->fees_model->getInvoiceStatus($studentId);
            $invoiceBasic = $this->fees_model->getInvoiceBasic($studentId);
            $invoiceDetails = $this->fees_model->getInvoiceDetails($studentId);

            if (empty($invoiceStatus) || empty($invoiceBasic) || empty($invoiceDetails)){
                $this->output->set_output(json_encode([
                    "ErrorCode" => 404,
                    "ErrorMsg" => "Invoice Not Found",
                ]));
            }else{
                $fully_total_fine = 0;
                $total_discount = 0;
                $total_balance = 0;

                foreach ($invoiceDetails as $invoiceDetail) {
                    $deposit = $this->fees_model->getStudentFeeDeposit($invoiceDetail['allocation_id'], $invoiceDetail['fee_type_id']);

                    $type_amount = $deposit['total_amount'];
                    $type_discount = $deposit['total_discount'];
                    $balance = $invoiceDetail['amount'] - ($type_amount + $type_discount);

                    $due_date = date('mY', strtotime($invoiceDetail['due_date']));
                    // Get Invoices by Bill Month and Previous Bill Months
                    if ($due_date == $billMonth || $due_date < $billMonth) {
                        // Get Invoices until the amount is not paid
                        // Add fine if the amount is not paid and the due date is passed
                        if ($type_amount == 0 || $type_amount > 0 && $balance > 0){
                            $total_discount += $type_discount;
                            $total_balance += $balance;

                            // Get fine
                            $fine = $this->fees_model->feeFineCalculation($invoiceDetail['allocation_id'], $invoiceDetail['fee_type_id'], get_session_id());
                            $b = $this->fees_model->getBalance($invoiceDetail['allocation_id'], $invoiceDetail['fee_type_id']);
                            $fine = abs($fine - $b['fine']);
                            $fully_total_fine += $fine;
                        }
                    }
                }

                $total_payable_amount = $total_balance + $fully_total_fine;

                // Check if the amount is paid
                if (($total_balance + $fully_total_fine) == 0){
                    $this->output->set_output(json_encode([
                        "ErrorCode" => 436,
                        "ErrorMsg" => "Already Paid",
                    ]));
                    return;
                }

                if (isset($amount)){
                    // If the customer is pay the minimum amount.
                    if ($amount < $total_payable_amount){
                        $this->output->set_output(json_encode([
                            "ErrorCode" => 438,
                            "ErrorMsg" => "Minimum Amount Not Paid",
                        ]));
                        return;
                    }

                    // If the Pay amount and billed amount don't match.
                    if ($amount != $total_payable_amount){
                        $this->output->set_output(json_encode([
                            "ErrorCode" => 439,
                            "ErrorMsg" => "Pay amount and billed amount not match",
                        ]));
                        return;
                    }
                }

                $this->output->set_output(json_encode([
                    "ErrorCode" => 200,
                    "ErrorMsg" => "Successful",
                    "ConsumerName" => $invoiceBasic['first_name'] ?? ' ' . $invoiceBasic['last_name'] ?? '',
                    "BillMonth" => $billMonth,
                    "BillAmount" => $total_payable_amount,
                    "BillDueDate" => date('Ymd', strtotime(date('yY-m-d'))),
                    "QueryTime" => date('YmdHis')
                ]));
            }
        }else{
            $this->output->set_output(json_encode([
                "ErrorCode" => 405,
                "ErrorMsg" => "Method Not Allowed",
            ]));
        }
    }

    public function bkash_pay_bill()
    {
        $this->initialize();
        $this->output->set_content_type('application/json');

        if ($_POST) {
            $userName = $this->input->post('UserName'); // required
            $password = $this->input->post('Password'); // required
            $accountNo = $this->input->post('AccNo'); // Optional
            $meterNo = $this->input->post('MasterNo'); // Optional
            $customerNo = $this->input->post('CustomerNo'); // Optional
            $billNo = $this->input->post('BillNo'); // Optional
            $refId = $this->input->post('RefID'); // Optional
            $billMonth = $this->input->post('BillMonth'); // Required
            $amount = $this->input->post('Amount'); // Required
            $trxId = $this->input->post('TrxID'); // Required
            $payTime = $this->input->post('PayTime'); // Required

            // Check if mandatory fields are empty
            if (empty($userName) || empty($password) || empty($billMonth) || empty($amount) || empty($trxId) || empty($payTime) ||
                empty($accountNo) && empty($meterNo) && empty($customerNo) && empty($billNo) && empty($refId)) {
                $this->output->set_output(json_encode([
                    "ErrorCode" => 400,
                    "ErrorMsg" => "Mandatory Fields are Empty",
                ]));
                return;
            }

            // Check if bkash credentials are empty
            if (empty($this->api_config['bkash_pay_bill_username']) || empty($this->api_config['bkash_pay_bill_password'])) {
                $this->output->set_output(json_encode([
                    "ErrorCode" => 404,
                    "ErrorMsg" => "Bkash Credentials Not Found",
                ]));
                return;
            }

            // Check Authentication
            if ($userName != $this->api_config['bkash_pay_bill_username'] || $password != $this->api_config['bkash_pay_bill_password']) {
                $this->output->set_output(json_encode([
                    "ErrorCode" => 403,
                    "ErrorMsg" => "Authentication Failed",
                ]));
                return;
            }


            // Get Invoice Information
            $studentId = $accountNo ?? $meterNo ?? $customerNo ?? $billNo ?? $refId;
            $invoiceStatus = $this->fees_model->getInvoiceStatus($studentId);
            $invoiceBasic = $this->fees_model->getInvoiceBasic($studentId);
            $invoiceDetails = $this->fees_model->getInvoiceDetails($studentId);

            if (empty($invoiceStatus) || empty($invoiceBasic) || empty($invoiceDetails)){
                $this->output->set_output(json_encode([
                    "ErrorCode" => 404,
                    "ErrorMsg" => "Invoice Not Found",
                ]));
                return;
            }else{
                $invoices = [];

                $fully_total_fine = 0;
                $total_discount = 0;
                $total_balance = 0;
                $total_amount = 0;

                foreach ($invoiceDetails as $invoiceDetail) {
                    $deposit = $this->fees_model->getStudentFeeDeposit($invoiceDetail['allocation_id'], $invoiceDetail['fee_type_id']);

                    $type_amount = $deposit['total_amount'];
                    $type_discount = $deposit['total_discount'];
                    $balance = $invoiceDetail['amount'] - ($type_amount + $type_discount);

                    $due_date = date('mY', strtotime($invoiceDetail['due_date']));
                    // Get Invoices by Bill Month and Previous Bill Months
                    if ($due_date == $billMonth || $due_date < $billMonth) {
                        // Get Invoices until the amount is not paid
                        // Add fine if the amount is not paid and the due date is passed
                        if ($type_amount == 0 || $type_amount > 0 && $balance > 0){
                            $total_discount += $type_discount;
                            $total_balance += $balance;
                            $total_amount += $invoiceDetail['amount'];

                            // Get fine
                            $fine = $this->fees_model->feeFineCalculation($invoiceDetail['allocation_id'], $invoiceDetail['fee_type_id'], get_session_id());
                            $b = $this->fees_model->getBalance($invoiceDetail['allocation_id'], $invoiceDetail['fee_type_id']);
                            $fine = abs($fine - $b['fine']);
                            $fully_total_fine += $fine;
                            $invoiceDetail['fine'] = $fine;

                            $invoices[] = $invoiceDetail;
                        }
                    }
                }

                $total_payable = $total_amount + $fully_total_fine - $total_discount;

                // Check if the amount is paid
                if ($total_payable == 0){
                    $this->output->set_output(json_encode([
                        "ErrorCode" => 436,
                        "ErrorMsg" => "Already Paid",
                    ]));
                    return;
                }

                // If the customer is pay the minimum amount.
                if ($amount < $total_payable){
                    $this->output->set_output(json_encode([
                        "ErrorCode" => 438,
                        "ErrorMsg" => "Minimum Amount Not Paid",
                    ]));
                    return;
                }

                // If the Pay amount and billed amount don't match.
                if ($amount != $total_payable){
                    $this->output->set_output(json_encode([
                        "ErrorCode" => 439,
                        "ErrorMsg" => "Pay amount and billed amount not match",
                    ]));
                    return;
                }

                // Save Transaction
                $transactions = [];
                foreach ($invoices as $invoice) {
                    $amount = $invoice['amount'];
                    $fineAmount = $invoice['fine'] ?? 0;
                    $discountAmount = 0;
                    $date = date('Y-m-d');
                    $payVia = 1;
                    $arrayFees = array(
                        'allocation_id' => $invoice['allocation_id'],
                        'type_id' => $invoice['fee_type_id'],
                        'collect_by' => 1,
                        'amount' => ($amount - $discountAmount),
                        'discount' => $discountAmount,
                        'fine' => $fineAmount,
                        'pay_via' => $payVia,
                        'remarks' => 'Payment via Bkash Bill',
                        'date' => $date,
                    );
                    $this->db->insert('fee_payment_history', $arrayFees);

                    // transaction voucher save function
                    if (isset($value['account_id'])) {
                        $arrayTransaction = array(
                            'account_id' => $value['account_id'],
                            'amount' => ($amount + $fineAmount) - $discountAmount,
                            'date' => $date,
                        );
                        $this->fees_model->saveTransaction($arrayTransaction);
                    }
                    // send payment confirmation sms
                    $arrayData = array(
                        'student_id' => $studentId,
                        'amount' => ($amount + $fineAmount) - $discountAmount,
                        'paid_date' => _d($date),
                    );
                    $this->sms_model->send_sms($arrayData, 2, 1);
                }

                $this->db->insert('bkash_pay_bill', [
                    'amount' => $total_payable,
                    'trx_id' => $trxId,
                    'ref_id' => $studentId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'data' => json_encode($invoices),
                ]);

                $this->output->set_output(json_encode([
                    "ErrorCode" => 200,
                    "ErrorMsg" => "Successful",
                    "ConsumerName" => $invoiceBasic['first_name'] ?? ' ' . $invoiceBasic['last_name'] ?? '',
                    "TotalAmount" => $total_payable,
                    "TrxID" => $trxId,
                    "MiddlewarePayTime" => date('YmdHis'),
                    "RefNumber" => $studentId,
                ]));
            }

        } else {
            $this->output->set_output(json_encode([
                "ErrorCode" => 405,
                "ErrorMsg" => "Method Not Allowed",
            ]));
        }
    }

    public function bkash_pay_bill_search_transaction()
    {
        $this->initialize();
        $this->output->set_content_type('application/json');

        if ($_POST) {
            $userName = $this->input->post('UserName'); // required
            $password = $this->input->post('Password'); // required
            $trxId = $this->input->post('TrxId'); // required

            // Check if mandatory fields are empty
            if (empty($userName) || empty($password) || empty($trxId)) {
                $this->output->set_output(json_encode([
                    "ErrorCode" => 400,
                    "ErrorMsg" => "Mandatory Fields are Empty",
                ]));
                return;
            }

            // Check if bkash credentials are empty
            if (empty($this->api_config['bkash_pay_bill_username']) || empty($this->api_config['bkash_pay_bill_password']) || empty($this->api_config['bkash_pay_bill_status']) && $this->api_config['bkash_pay_bill_status'] == 0) {
                $this->output->set_output(json_encode([
                    "ErrorCode" => 404,
                    "ErrorMsg" => "Bkash Credentials Not Found",
                ]));
                return;
            }

            // Check Authentication
            if ($userName != $this->api_config['bkash_pay_bill_username'] || $password != $this->api_config['bkash_pay_bill_password']) {
                $this->output->set_output(json_encode([
                    "ErrorCode" => 403,
                    "ErrorMsg" => "Authentication Failed",
                ]));
                return;
            }

            // Find the transaction
            $transaction = $this->db->where('trx_id', $trxId)->get('bkash_pay_bill')->row_array();

            if ($transaction){
                $this->output->set_output(json_encode([
                    "ErrorCode" => 200,
                    "ErrorMsg" => "Successful",
                    "TotalAmount" => $transaction['amount'],
                    "TrxId" => $transaction['trx_id'],
                    "MiddlewarePayTime" => date('YmdHis', strtotime($transaction['created_at'])),
                    "RefId" => $transaction['ref_id'],
                    "CustomMessage" => "",
                    "AmountBreakdown" => ""
                ]));
            } else {
                $this->output->set_output(json_encode([
                    "ErrorCode" => 404,
                    "ErrorMsg" => "Transaction Not Found",
                ]));
            }
        }
    }
}