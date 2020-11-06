import { extend } from 'vee-validate';
import { required, alpha_spaces, alpha_dash, between, numeric } from 'vee-validate/dist/rules';

extend('positive', value => {
  return value >= 0;
});

extend('required', {
    ...required,
    message: 'This field is required'
});

extend('alpha_spaces', {
    ...alpha_spaces,
    message: 'This field takes only letters and spaces'
});

extend('alpha_dash', {
    ...alpha_dash,
    message: 'This field takes only letters, numbers, dashes and underscores'
});

extend('between', {
    ...between,
    message: 'This field takes only numbers between 0 and 110'
});

extend('numeric', {
    ...numeric,
    message: 'This field takes only numbers'
});