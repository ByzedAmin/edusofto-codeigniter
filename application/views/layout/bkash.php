<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Merchant</title>
    <meta name="viewport" content="width=device-width" ,="" initial-scale="1.0/">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrom=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>

<div class="border d-flex align-items-center justify-content-center" style="min-height: 100vh">
    <button id="bKash_button" class="btn btn-primary" style="display: none">Pay Now</button>

    <div id="loading" class="text-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Please Wait...</span>
        </div>

        <div class="ms-3">Please Wait...</div>
    </div>

    <!--- Show Confirmation -->
    <div id="complete" class="text-center" style="display: none">
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>

        <div class="text-success">Please wait...</div>
        <p class="text-danger">Do not refresh or close this page.</p>
    </div>
</div>

<script type="text/javascript">
    var paymentId = null

    $(document).ready(function () {
        $.ajax({
            url: "<?php echo $token_url; ?>",
            type: 'POST',
            contentType: 'application/json',
            success: function (res) {
                res = JSON.parse(res)
                if (res.hasOwnProperty('id_token')){
                    initBkash(res.id_token)
                }else if (res.hasOwnProperty('msg')){
                    notify('error', res.msg)
                } else {
                    notify('error', 'Something went wrong')
                }
            },
            error: function(){
                notify('error', 'Payment Failed')
            },
            complete: function(){
                $('#bKash_button').click()
            }
        });
    });

    function initBkash(accessToken) {
        clickPayButton();
        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: {
                amount: "<?php echo $amount; ?>",
                currency: "BDT",
                intent: "sale",
                merchantInvoiceNumber: "<?php echo $invoice_no; ?>",
                merchantAssociationInfo: "<?php echo $student_name; ?>",
                token: accessToken
            },
            createRequest: function (request) {
                $.ajax({
                    url: "<?php echo $checkout_url; ?>",
                    method:'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(request),
                    success: function(res) {
                        try {
                            var response = JSON.parse(res);
                            paymentId = response.paymentID;
                            if (response.message === 'Unauthorized') {
                                notify('error', 'Unauthorized')
                            } else {
                                $('#loading').hide()
                                bKash.create().onSuccess(response);
                            }
                        } catch (e) {
                            $('#bKash_button').hide()
                            bKash.create().onError();
                        }
                    },
                    error: function(xhr, status, error){
                        notify('error', 'Payment Failed')
                        $('#bKash_button').hide()
                        bKash.create().onError();
                    }
                });
            },
            executeRequestOnAuthorization: function() {
                $.ajax({
                    url: "<?php echo $execute_url; ?>",
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        token: accessToken,
                        paymentID: paymentId
                    }),
                    success: function(data) {
                       try {
                            var response = JSON.parse(data);
                            if (response.paymentID) {
                                notify('success', "Payment Successful. Please don't close this window.")
                                $('#complete').show()
                                $('#bKash_button').hide()
                                window.location.href = "<?php echo $success_url; ?>"+"?payment_id="+response.paymentID+"&token="+accessToken;
                            } else {
                                showErrorMessage(response);
                                bKash.execute().onError();
                            }
                        } catch (e) {
                            $('#bKash_button').hide()
                            bKash.execute().onError();
                            notify('error', e.message)
                        }
                    },
                    error: function(err) {
                        $('#bKash_button').hide()
                        showErrorMessage(err.responseJSON);
                        bKash.execute().onError();
                    }
                });
            }
        });
    }

    function callReconfigure(val) {
        bKash.reconfigure(val);
    }

    function clickPayButton() {
        $("#bKash_button").trigger('click');
    }

    function getPaymentId(token) {
        let paymentID = '';
        $.ajax({
            url: "<?php echo $checkout_url; ?>",
            type: 'POST',
            contentType: 'json',
            data: {
                token,
                amount: "<?php echo $amount; ?>",
                currency: "BDT",
                intent: "sale",
                merchantInvoiceNumber: "<?php echo $invoice_no; ?>",
                merchantAssociationInfo: "<?php echo $student_name; ?>"
            },
            success: function(res) {
                try {
                    var response = JSON.parse(res);

                    if(data && response.paymentID != null){
                        paymentID = response.paymentID;
                        bKash.create().onSuccess(response);
                    }
                    else {
                        showErrorMessage(res)
                        bKash.create().onError();
                    }
                } catch (e) {
                    notify('error', 'Payment Failed')
                    bKash.create().onError();
                }
            },
            error: function(err){
                showErrorMessage(err.responseJSON);
                bKash.create().onError();
            }
        });

        return paymentID;
    }

    function notify(status, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: status,
            title: message
        })
    }

    function showErrorMessage(response) {
        let message = 'Unknown Error';
        if (response.hasOwnProperty('errorMessage')) {
            let errorCode = parseInt(response.errorCode);
            let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014,
                2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
                2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046,
                2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                2063, 2064, 2065, 2066, 2067, 2068, 2069, 503,
            ];
            if (bkashErrorCode.includes(errorCode)) {
                message = response.errorMessage
            }
        }
        notify('error', message)
    }

</script>

</body>
</html>
