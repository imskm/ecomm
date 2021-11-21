<?php $this->use('templates/base.php', ['title' => 'Payment']) ?>

<button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
var options = <?= json_encode($rzp_data) ?>;
options.handler = (response) => {
    // alert(response.razorpay_payment_id);
    // alert(response.razorpay_order_id);
    // alert(response.razorpay_signature);
    const url = "/payment/store";
    const form = new URLSearchParams();
    form.append("razorpay_payment_id", response.razorpay_payment_id);
    form.append("razorpay_order_id", response.razorpay_order_id);
    form.append("razorpay_signature", response.razorpay_signature);

    axios.post(url, form).then((response) => {
        alert("Payment Susccessful!");
        console.log(response);
    }).catch((error) => {
        alert("Payment Failure!");
        console.error(error);
    });
};

var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
    const url = "/payment/failure";
    const form = new URLSearchParams();
    form.append("razorpay_payment_id", response.error.metadata.payment_id);
    form.append("razorpay_order_id", response.error.metadata.order_id);

    axios.post(url, form).then((response) => {
        // alert("Payment Susccessful!");
    }).catch((error) => {
        // alert("Payment Failure!");
    });

    console.error(response.error);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>