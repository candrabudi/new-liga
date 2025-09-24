<div class="form-group deposit-form-group">
    <label for="PaymentMethod">Metode Pembayaran</label>
    <div id="payment_method_selection" class="payment-method-selection">
        <div>
            <input type="radio" name="PaymentType" id="payment_method_QR" value="QR">
            <label for="payment_method_QR">
                <img loading="lazy" src="//dsuown9evwz4y.cloudfront.net/Images/payment-types/QR.svg?v=20250528"
                    alt="QRIS">
                <span>QRIS</span>
            </label>
        </div>
        <div>
            <input type="radio" name="PaymentType" id="payment_method_BANK" value="BANK">
            <label for="payment_method_BANK">
                <img loading="lazy" src="//dsuown9evwz4y.cloudfront.net/Images/payment-types/BANK.svg?v=20250528"
                    alt="Bank">
                <span>Bank</span>
            </label>
        </div>
        <div>
            <input type="radio" name="PaymentType" id="payment_method_EMONEY" value="EMONEY">
            <label for="payment_method_EMONEY">
                <img loading="lazy" src="//dsuown9evwz4y.cloudfront.net/Images/payment-types/EMONEY.svg?v=20250528"
                    alt="E-Money">
                <span>E-Money</span>
            </label>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const radios = document.querySelectorAll('#payment_method_selection input[type="radio"]');
    const labels = document.querySelectorAll('#payment_method_selection label');

    // mapping route ke value radio
    const routeMap = {
        '/mobile/deposit/qris': 'QR',
        '/mobile/deposit/virtual-account': 'VA',
        '/mobile/deposit/bank': 'BANK',
        '/mobile/deposit/emoney': 'EMONEY'
    };

    const valueMap = {
        'QR': '/mobile/deposit/qris',
        'VA': '/mobile/deposit/virtual-account',
        'BANK': '/mobile/deposit/bank',
        'EMONEY': '/mobile/deposit/emoney'
    };

    // cek route saat ini dan set radio sesuai
    const currentRoute = window.location.pathname;
    if (routeMap[currentRoute]) {
        const radioToCheck = document.querySelector(
            `#payment_method_selection input[value="${routeMap[currentRoute]}"]`);
        if (radioToCheck) radioToCheck.checked = true;
    }

    function updateActive() {
        labels.forEach(label => label.classList.remove('active'));
        const checkedInput = document.querySelector(
            '#payment_method_selection input[type="radio"]:checked');
        if (checkedInput) {
            checkedInput.nextElementSibling.classList.add('active');

            // redirect hanya jika route berbeda
            const targetRoute = valueMap[checkedInput.value];
            if (targetRoute && window.location.pathname !== targetRoute) {
                window.location.href = targetRoute;
            }
        }
    }

    updateActive();

    radios.forEach(input => {
        input.addEventListener('change', updateActive);
    });
});
</script>
