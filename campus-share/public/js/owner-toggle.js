

document.addEventListener('DOMContentLoaded', () => {
    const postForm = document.querySelector('form[action*="owner/post-item"], form[action*="owner/add-resource"]');

    if (postForm) {
        const sharingSelect = postForm.querySelector('select[name="sharing_type"]');
        const dailyRateInput = postForm.querySelector('input[name="daily_rate"]');
        const depositInput = postForm.querySelector('input[name="security_deposit"]');

        function togglePricingFields() {
            if (!sharingSelect || !dailyRateInput || !depositInput) return;

            const isDonate = (sharingSelect.value === 'donate');

            if (isDonate) {
               
                dailyRateInput.value = '0';
                depositInput.value = '0';
                dailyRateInput.readOnly = true;
                depositInput.readOnly = true;
                
                
                dailyRateInput.style.backgroundColor = '#f1f5f9';
                dailyRateInput.style.cursor = 'not-allowed';
                depositInput.style.backgroundColor = '#f1f5f9';
                depositInput.style.cursor = 'not-allowed';
            } else {
                dailyRateInput.readOnly = false;
                depositInput.readOnly = false;
                dailyRateInput.style.backgroundColor = '#ffffff';
                dailyRateInput.style.cursor = 'text';
                depositInput.style.backgroundColor = '#ffffff';
                depositInput.style.cursor = 'text';
            }
        }

        
        sharingSelect.addEventListener('change', togglePricingFields);

        
        togglePricingFields();
    }
});