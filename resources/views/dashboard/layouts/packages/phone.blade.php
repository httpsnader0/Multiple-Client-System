<script>
    var input = document.querySelector('[name="phone"]');
    var phoneCode = window.intlTelInput(input, {
        separateDialCode: true,
        preferredCountries: ['eg', 'sa', 'kw', 'ae'],
        setNumber: '+201098683990',
    });
</script>
