$(document).ready(function(){
    $('#btn_personal').click(function(){
        var error_fname = '';
        var error_mname = '';
        var error_lname = '';
        var error_bod = '';
        var error_gender = '';
        var error_mstatus = '';
        var error_dept = '';
        var error_gradyear = '';
                                
        //first name
        if($.trim($('#firstName').val()).length==0)
        {
            error_fname = 'First Name is required';
            $('#error_fname').text(error_fname);
            $('#firstName').addClass('has-error');
        }else
        {
            error_fname = '';
            $('#error_fname').text(error_fname);
            $('#firstName').removeClass('has-error');
        }
            //Middle Name
        if($.trim($('#middleName').val()).length==0)
        {
            error_mname = 'Middle Name is required';
            $('#error_mname').text(error_mname);
            $('#middleName').addClass('has-error');
        }else
        {
            error_mname = '';
            $('#error_mname').text(error_mname);
            $('#middleName').removeClass('has-error');
        }
            // Last Name
        if($.trim($('#lastName').val()).length==0)
        {
            error_lname = 'Last Name is required';
            $('#error_lname').text(error_lname);
            $('#lastName').addClass('has-error');
        }else
        {
            error_lname = '';
            $('#error_lname').text(error_lname);
            $('#lastName').removeClass('has-error');
        }
        // birthdate
        if($.trim($('#dob').val()).length==0)
        {
            error_dob = 'Birth Date is required';
            $('#error_dob').text(error_dob);
            $('#dob').addClass('has-error');
        }else
        {
            error_dob = '';
            $('#error_dob').text(error_dob);
            $('#dob').removeClass('has-error');
        }
        
        // gender
        if($.trim($('#gender').val()).length==0)
        {
            error_gender = 'Gender is required';
            $('#error_gender').text(error_gender);
            $('#gender').addClass('has-error');
        }else
        {
            error_gender = '';
            $('#error_gender').text(error_gender);
            $('#gender').removeClass('has-error');
        }
        // marital status
        if($.trim($('#maritalstatus').val()).length==0)
        {
            error_mstatus = 'Marital status is required';
            $('#error_maritalstatus').text(error_mstatus);
            $('#maritalstatus').addClass('has-error');
        }else
        {
            error_mstatus = '';
            $('#error_maritalstatus').text(error_mstatus);
            $('#maritalstatus').removeClass('has-error');
        }

        // Department
        if($.trim($('#department').val()).length==0)
        {
            error_dept = 'Department is required';
            $('#error_department').text(error_dept);
            $('#department').addClass('has-error');
        }else
        {
            error_dept = '';
            $('#error_department').text(error_dept);
            $('#department').removeClass('has-error');
        }

        // Year of Graduation
        if($.trim($('#bscgraduationyear').val()).length==0)
        {
            error_gradyear = 'Year of Graduation is required';
            $('#error_bscgraduationyear').text(error_gradyear);
            $('#bscgraduationyear').addClass('has-error');
        }else
        {
            error_gradyear = '';
            $('#error_bscgraduationyear').text(error_gradyear);
            $('#bscgraduationyear').removeClass('has-error');
        }
        
            // checking and tab control
        if(error_fname!='' || error_lname!='' || error_mname!=''|| error_dob!=''|| error_gender!=''|| error_mstatus!=''|| error_dept!=''|| error_gradyear!='')
        {
            return false;
        }
        else
        {
            $('#tab_personal_details').removeClass('active active-tab1');
            $('#tab_personal_details').removeAttr('href data-toggle');
            $('#personal_details').removeClass('active');
            $('#tab_personal_details').addClass('inactive-tab1');
            $('#tab_address_details').removeClass('inactive-tab1');
            $('#tab_address_details').addClass('active-tab1 active');
            $('#tab_address_details').attr('href','#address-details');
            $('#tab_address_details').attr('data-toggle','tab');
            $('#address_details').addClass('active in');
        }

    });
    $('#previous_btn_address').click(function(){

        $('#tab_address_details').removeClass('active active-tab1');
        $('#tab_address_details').removeAttr('href data-toggle');
        $('#address_details').removeClass('active in');
        $('#tab_address_details').addClass('inactive-tab1');
        $('#tab_personal_details').removeClass('inactive-tab1');
        $('#tab_personal_details').addClass('active-tab1 active');
        $('#tab_personal_details').attr('href','#personal_details');
        $('#tab_personal_details').attr('data-toggle','tab');
        $('#personal_details').addClass('active in');
    });
    
    // Address Tab

    $('#btn_address').click(function(){
        var error_country = '';
        var error_state = '';
       // var error_officephone = '';
        var error_phone1 = '';
        //var error_phone2 = '';
        var error_email = '';
        //var error_facebook = '';
        //var error_linkedin = '';

         // Country
         if($.trim($('#country').val()).length==0)
         {
             error_country = 'Country is required';
             $('#error_country').text(error_country);
             $('#country').addClass('has-error');
         }else
         {
             error_country = '';
             $('#error_country').text(error_country);
             $('#country').removeClass('has-error');
         }
         // State
         if($.trim($('#state').val()).length==0)
         {
             error_state = 'State is required';
             $('#error_state').text(error_state);
             $('#state').addClass('has-error');
         }else
         {
             error_state = '';
             $('#error_state').text(error_state);
             $('#state').removeClass('has-error');
         }

         // Phone
         if($.trim($('#phone1').val()).length==0)
         {
             error_phone1 = 'Phone is required';
             $('#error_phone1').text(error_phone1);
             $('#phone1').addClass('has-error');
         }else
         {
             error_phone1 = '';
             $('#error_phone1').text(error_phone1);
             $('#phone1').removeClass('has-error');
         }

         // Email
         if($.trim($('#email').val()).length==0)
         {
             error_email = 'Email is required';
             $('#error_email').text(error_email);
             $('#email').addClass('has-error');
         }else
         {
             error_email = '';
             $('#error_email').text(error_email);
             $('#email').removeClass('has-error');
         }

         if(error_country!='' || error_state!='' || error_phone1!='' || error_email!='')
        {
            return false;
        }
        else
        {
            $('#tab_address_details').removeClass('active active-tab1');
            $('#tab_address_details').removeAttr('href data-toggle');
            $('#address_details').removeClass('active in');
            $('#tab_address_details').addClass('inactive-tab1');
            $('#tab_employeement_details').removeClass('inactive-tab1');
            $('#tab_employeement_details').addClass('active-tab1 active');
            $('#tab_employeement_details').attr('href','#employeement_details');
            $('#tab_employeement_details').attr('data-toggle','tab');
            $('#employeement_details').addClass('active in');
        }
    });
    $('#previous_btn_employeement').click(function(){

        $('#tab_employeement_details').removeClass('active active-tab1');
        $('#tab_employeemet_details').removeAttr('href data-toggle');
        $('#employeement_details').removeClass('active in');
        $('#tab_employeement_details').addClass('inactive-tab1');
        $('#tab_address_details').removeClass('inactive-tab1');
        $('#tab_address_details').addClass('active-tab1 active');
        $('#tab_address_details').attr('href','#address_details');
        $('#tab_address_details').attr('data-toggle','tab');
        $('#address_details').addClass('active in');
    });

    // Employeement Tab
    $('#btn_employeement').click(function(){
       /* var error_employer = '';
        var error_empaddress = '';
        var error_empcategory = ''; 
        var error_title = '';                                   
        var error_salary = '';
        var error_emptype = '';
        var error_empinfo = '';
        
        if($.trim($('#employer').val()).length==0)
        {
            error_employer = 'Employer Name is required';
            $('#error_employer').text(error_employer);
            $('#employer').addClass('has-error');
        }else
        {
            error_employer = '';
            $('#error_employer').text(error_employer);
            $('#employer').removeClass('has-error');
        }
            
        
            // Employer Address
        if($.trim($('#empaddress').val()).length==0)
        {
            error_empaddress = 'Employer Address is required';
            $('#error_empaddress').text(error_empaddress);
            $('#empaddress').addClass('has-error');
        }else
        {
            error_empaddress = '';
            $('#error_empaddress').text(error_empaddress);
            $('#empaddress').removeClass('has-error');
        }
            // Employer category
        if($.trim($('#empcategory').val()).length==0)
        {
            error_empcategory = 'Employer Category is required';
            $('#error_empcategory').text(error_empcategory);
            $('#empcategory').addClass('has-error');
        }else
        {
            error_empcategory = '';
            $('#error_empcategory').text(error_empcategory);
            $('#empcategory').removeClass('has-error');
        }

        // Position Title
        if($.trim($('#position').val()).length==0)
        {
            error_title = 'Position is required';
            $('#error_title').text(error_title);
            $('#position').addClass('has-error');
        }else
        {
            error_title = '';
            $('#error_title').text(error_title);
            $('#position').removeClass('has-error');
        }

         // Salary
         if($.trim($('#salary').val()).length==0)
         {
             error_salary = 'Salary is required';
             $('#error_salary').text(error_salary);
             $('#salary').addClass('has-error');
         }else
         {
             error_salary = '';
             $('#error_salary').text(error_salary);
             $('#salary').removeClass('has-error');
         }
         // Salary
         if($.trim($('#emptype').val()).length==0)
         {
             error_emptype = 'Employment Type is required';
             $('#error_emptype').text(error_emptype);
             $('#emptype').addClass('has-error');
         }else
         {
             error_emptype = '';
             $('#error_emptype').text(error_emptype);
             $('#emptype').removeClass('has-error');
         }
         // Employment Info
         if($.trim($('#empinfo').val()).length==0)
         {
             error_empinfo = 'Employment Information is required';
             $('#error_empinfo').text(error_empinfo);
             $('#empinfo').addClass('has-error');
         }else
         {
             error_empinfo = '';
             $('#error_empinfo').text(error_empinfo);
             $('#empinfo').removeClass('has-error');
         }
            // checking and tab control
        if(error_employer!='' || error_empaddress!='' || error_empcategory!='')
        {
            return false;
        }
        else
        {
            */
            $('#tab_employeement_details').removeClass('active active-tab1');
            $('#tab_employeement_details').removeAttr('href data-toggle');
            $('#employeement_details').removeClass('active');
            $('#tab_employeement_details').addClass('inactive-tab1');
            $('#tab_privatecompany_details').removeClass('inactive-tab1');
            $('#tab_privatecompany_details').addClass('active-tab1 active');
            $('#tab_privatecompany_details').attr('href','#privatecompany-details');
            $('#tab_privatecompany_details').attr('data-toggle','tab');
            $('#privatecompany_details').addClass('active in');
        //}

    });

    // Private Company Previous
    $('#previous_btn_privatecompany').click(function(){
        $('#tab_privatecompany_details').removeClass('active active-tab1');
        $('#tab_privatecompany_details').removeAttr('href data-toggle');
        $('#privatecompany_details').removeClass('active');
        $('#tab_privatecompany_details').addClass('inactive-tab1');
        $('#tab_employeement_details').removeClass('inactive-tab1');
        $('#tab_employeement_details').addClass('active-tab1 active');
        $('#tab_employeement_details').attr('href','#employeement-details');
        $('#tab_employeement_details').attr('data-toggle','tab');
        $('#employeement_details').addClass('active in');
    });

    //Private Company Next
    $('#btn_privatecompany').click(function(){

        $('#tab_privatecompany_details').removeClass('active active-tab1');
        $('#tab_privatecompany_details').removeAttr('href data-toggle');
        $('#privatecompany_details').removeClass('active');
        $('#tab_privatecompany_details').addClass('inactive-tab1');
        $('#tab_pgstudy_details').removeClass('inactive-tab1');
        $('#tab_pgstudy_details').addClass('active-tab1 active');
        $('#tab_pgstudy_details').attr('href','#pgstudy-details');
        $('#tab_pgstudy_details').attr('data-toggle','tab');
        $('#pgstudy_details').addClass('active in');
    });

    //PGStudy Previous
    $('#previous_btn_pgstudy').click(function(){
        $('#tab_pgstudy_details').removeClass('active active-tab1');
        $('#tab_pgstudy_details').removeAttr('href data-toggle');
        $('#pgstudy_details').removeClass('active');
        $('#tab_pgstudy_details').addClass('inactive-tab1');
        $('#tab_privatecompany_details').removeClass('inactive-tab1');
        $('#tab_privatecompany_details').addClass('active-tab1 active');
        $('#tab_privatecompany_details').attr('href','#privatecompany-details');
        $('#tab_privatecompany_details').attr('data-toggle','tab');
        $('#privatecompany_details').addClass('active in');

    });

     //PGStudy Next
     $('#btn_pgstudy').click(function(){
        $('#tab_pgstudy_details').removeClass('active active-tab1');
        $('#tab_pgstudy_details').removeAttr('href data-toggle');
        $('#pgstudy_details').removeClass('active');
        $('#tab_pgstudy_details').addClass('inactive-tab1');
        $('#tab_certificate_details').removeClass('inactive-tab1');
        $('#tab_certificate_details').addClass('active-tab1 active');
        $('#tab_certificate_details').attr('href','#certificate-details');
        $('#tab_certificate_details').attr('data-toggle','tab');
        $('#certificate_details').addClass('active in');
    });
    //PGStudy Next
    $('#previous_btn_certificate').click(function(){
        $('#tab_certificate_details').removeClass('active active-tab1');
        $('#tab_certificate_details').removeAttr('href data-toggle');
        $('#certificate_details').removeClass('active');
        $('#tab_certificate_details').addClass('inactive-tab1');
        $('#tab_pgstudy_details').removeClass('inactive-tab1');
        $('#tab_pgstudy_details').addClass('active-tab1 active');
        $('#tab_pgstudy_details').attr('href','#pgstudy-details');
        $('#tab_pgstudy_details').attr('data-toggle','tab');
        $('#pgstudy_details').addClass('active in');

    });
});