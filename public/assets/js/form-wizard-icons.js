/**
 *  Form Wizard
 */

'use strict';

(function () {
  // Icons Modern Wizard
  // --------------------------------------------------------------------
  const wizardIconsModern = document.querySelector('.wizard-modern-icons-example');

  if (typeof wizardIconsModern !== undefined && wizardIconsModern !== null) {
    const wizardIconsModernBtnNextList = [].slice.call(wizardIconsModern.querySelectorAll('.btn-next')),
      wizardIconsModernBtnPrevList = [].slice.call(wizardIconsModern.querySelectorAll('.btn-prev'));

    const modernIconsStepper = new Stepper(wizardIconsModern, {
      linear: false
    });

    if (wizardIconsModernBtnPrevList) {
      wizardIconsModernBtnPrevList.forEach(wizardIconsModernBtnPrev => {
        wizardIconsModernBtnPrev.addEventListener('click', event => {
          modernIconsStepper.previous();
        });
      });
    }
    if (wizardIconsModernBtnNextList) {
      wizardIconsModernBtnNextList.forEach(wizardIconsModernBtnNext => {
        wizardIconsModernBtnNext.addEventListener('click', event => {
          modernIconsStepper.next();
        });
      });
    }
  }
})();
