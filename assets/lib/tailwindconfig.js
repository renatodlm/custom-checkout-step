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
   ],
}

var checkoutForm = {
   currentStep: 1,
   stepTitle: 'Endereço de E-mail',
   nextStep() {
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
   updateStepTitle() {
      switch (this.currentStep) {
         case 1:
            this.stepTitle = 'Endereço de E-mail';
            break;
         case 2:
            this.stepTitle = 'Dados de entrega';
            break;
         case 3:
            this.stepTitle = 'Pagamento';
            break;
      }
   }
}
