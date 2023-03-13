tailwind.config = {
   theme: {
      container: {
         center: true,
         padding: {
            DEFAULT: '15px',
         },
      },
      extend: {
         screens: {
            xs: '420px',
         },
         colors: {
            neutral: {
               500: '#f6f6f6',
            },
            green: {
               500: '#007b6f',
            },
         },
      },
   },
   safelist: [
      'hidden',
      'text-[0.75rem]',
   ],
}

var checkoutForm = {
   currentStep: 1,
   step1completed: false,
   step2completed: false,
   step3completed: false,
   billing_email: '',
   billing_first_name: '',
   billing_last_name: '',
   billing_country: '',
   billing_address_1: '',
   billing_address_2: '',
   billing_city: '',
   billing_state: '',
   billing_postcode: '',
   billing_phone: '',
   stepTitle: 'Contact information',
   nextStep() {
      if (this.currentStep === 1) {

         if (!this.validateEmail(billing_email.value) || billing_email.value.length < 5) {
            inputInvalidMgsError(billing_email, false, 'Invalid email!')
            return
         }
         inputInvalidMgsError(billing_email, true)
      }

      if (this.currentStep === 2) {
         let validStep2 = true

         inputInvalidMgsError(billing_first_name, true)
         inputInvalidMgsError(billing_last_name, true)
         inputInvalidMgsError(billing_country, true)
         inputInvalidMgsError(billing_city, true)
         inputInvalidMgsError(billing_state, true)
         inputInvalidMgsError(billing_postcode, true)
         inputInvalidMgsError(billing_phone, true)

         if (billing_first_name.value.length < 3) {
            inputInvalidMgsError(billing_first_name, false, 'Invalid First name')
            validStep2 = false
         }
         if (billing_last_name.value.length < 3) {
            inputInvalidMgsError(billing_last_name, false, 'Invalid Last name')
            validStep2 = false
         }
         if (billing_country.value.length === 0) {
            inputInvalidMgsError(billing_country, false, 'Invalid Country')
            validStep2 = false
         }
         if (billing_city.value.length < 5) {
            inputInvalidMgsError(billing_city, false, 'Invalid City')
            validStep2 = false
         }

         if (billing_address_1.value.length < 5) {
            inputInvalidMgsError(billing_address_1, false, 'Invalid Address')
            validStep2 = false
         }

         const styles_billing_state = window.getComputedStyle(billing_state.parentNode.parentNode);
         if (styles_billing_state.display !== "none")
            if (billing_state.value.length < 2) {
               inputInvalidMgsError(billing_state, false, 'Invalid State')
               validStep2 = false
            }

         const styles_billing_postcode = window.getComputedStyle(billing_postcode.parentNode.parentNode);
         if (styles_billing_postcode.display !== "none")
            if (billing_postcode.value.length < 4) {
               inputInvalidMgsError(billing_postcode, false, 'Invalid Postcode')
               validStep2 = false
            }

         if (billing_phone.value.length < 5 || !isNumber(billing_phone.value)) {
            inputInvalidMgsError(billing_phone, false, 'Invalid Phone')
            validStep2 = false
         }
         if (!validStep2)
            return
      }
      this.billing_country = billing_country.value
      this.billing_state = billing_state.value

      if (this.currentStep < 3) {
         this.currentStep++;
      }
      this.updateStepTitle();
   },
   prevStep() {
      if (this.currentStep > 1) {
         this.currentStep--;
      }
      this.updateStepTitle();
   },
   setStep(step) {
      if (!step) return
      this.currentStep = step
   },
   updateStepTitle() {
      switch (this.currentStep) {
         case 1:
            this.stepTitle = 'Contact information';
            break;
         case 2:
            this.stepTitle = 'Shipping';
            this.step1completed = true
            break;
         case 3:
            this.stepTitle = 'Payment';
            this.step1completed = true
            this.step2completed = true
            break;
      }
   },
   validateEmail(email) {
      const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return pattern.test(email);
   },
}

function inputInvalidMgsError(el, validation = true, msg = 'Required field') {
   if (typeof el === 'undefined' && el) return

   el.parentNode.parentNode.classList.remove('woocommerce-invalid')
   el.parentNode.querySelector('.input-error')?.remove()

   if (!validation) {
      el.parentNode.parentNode.classList.add('woocommerce-invalid')

      // if (!el.parentNode.querySelector('span'))
      //    el.insertAdjacentHTML('afterend', `<span class="input-error text-[0.75rem] text-red-500 mt-2">${msg}</span>`)
   }
}

function isNumber(value) {
   return /^[0-9]+$/.test(value);
}
jQuery(document).ready(function ($) {
   $('#billing_country').select2();
   $('#billing_state').select2();
});
