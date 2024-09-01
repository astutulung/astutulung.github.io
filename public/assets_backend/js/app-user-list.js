$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // Datatable (jquery)
  $(function () {
    let borderColor, bodyBg, headingColor;

    if (isDarkStyle) {
      borderColor = config.colors_dark.borderColor;
      bodyBg = config.colors_dark.bodyBg;
      headingColor = config.colors_dark.headingColor;
    } else {
      borderColor = config.colors.borderColor;
      bodyBg = config.colors.bodyBg;
      headingColor = config.colors.headingColor;
    }

    // Variable declaration for table
    var dt_user_table = $('.datatables-users'),
      select2 = $('.select2'),
      userView = 'app-user-view-account.html';

    if (select2.length) {
      var $this = select2;
      select2Focus($this);
      $this.wrap('<div class="position-relative"></div>').select2({
        placeholder: 'Select Country',
        dropdownParent: $this.parent()
      });
    }

    $(document).ready(function () {
      var dt_user_table = $('#dt_user_table');

      if (dt_user_table.length) {
        // Hapus inisiasi DataTable
        $('.add-new').html(
          "<button class='btn btn-primary waves-effect waves-light' data-bs-toggle='offcanvas' data-bs-target='#offcanvasAddUser'><i class='ri-add-line me-0 me-sm-1 d-inline-block d-sm-none'></i><span class='d-none d-sm-inline-block'> Add New User </span></button>"
        );
      }
    });
  });



  (function () {
    const phoneMaskList = document.querySelectorAll('.phone-mask'),
      addNewUserForm = document.getElementById('addNewUserForm');


    if (phoneMaskList) {
      phoneMaskList.forEach(function (phoneMask) {
        new Cleave(phoneMask, {
          phone: true,
          phoneRegionCode: 'US'
        });
      });
    }

    const fv = FormValidation.formValidation(addNewUserForm, {
      fields: {
        nama: {
          validators: {
            notEmpty: {
              message: 'Please enter fullname '
            }
          }
        },
        jk: {
          validators: {
            notEmpty: {
              message: 'Please select a gender'
            }
          }
        },
        no_tlpn: {
          validators: {
            notEmpty: {
              message: 'Please enter a contact number'
            },
            stringLength: {
              max: 20,
              message: 'The contact number must not exceed 20 characters'
            }
          }
        },
        email: {
          validators: {
            notEmpty: {
              message: 'Please enter your email'
            },
            emailAddress: {
              message: 'The value is not a valid email address'
            }
          }
        },
        password: {
          validators: {
            notEmpty: {
              message: 'Please enter a password'
            },
            stringLength: {
              min: 8,
              message: 'The password must be at least 8 characters long'
            }
          }
        },
        role: {
          validators: {
            notEmpty: {
              message: 'Please select a role'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
          rowSelector: function (field, ele) {
            return '.mb-5';
          }
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      }
    }).on('core.form.valid', function () {
      $.ajax({
        url: $('#addNewUserForm').attr('action'),
        method: 'POST',
        data: $('#addNewUserForm').serialize(),
        success: function (response) {
          if (response.success) {
            Swal.fire({
              title: 'Success!',
              text: response.message,
              icon: 'success',
              customClass: {
                confirmButton: 'btn btn-primary waves-effect waves-light'
              },
              buttonsStyling: false
            }).then(() => {
              window.location.href = '/user';
            });
          } else {
            Swal.fire({
              title: 'Error!',
              text: response.message,
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-primary waves-effect waves-light'
              },
              buttonsStyling: false
            });
          }
        },
        error: function (response) {
          var errorMessage = 'An error occurred while creating the user.';
          if (response.responseJSON && response.responseJSON.message) {
            errorMessage = response.responseJSON.message;
          }
          Swal.fire({
            title: 'Error!',
            text: errorMessage,
            icon: 'error',
            customClass: {
              confirmButton: 'btn btn-primary waves-effect waves-light'
            },
            buttonsStyling: false
          });
        }
      });
    });
  })();
});
