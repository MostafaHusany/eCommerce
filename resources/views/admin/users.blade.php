@extends('layouts.admin')

@section('content')

<div class="alert alert-danger" id="generic-error" style="display: none">
  <b>There is an error happend while loading the page, please resfresh the page !!</b>
</div><!-- /.alert -->

<!-- latest User -->
<div class="panel panel-default users-table">
  <div class="panel-heading main-color-bg clearfix">
    <h3 class="panel-title pull-left" style="margin-top:5px;">Users</h3>
    <button type="button" class="pull-right btn btn-default btn-sm table-toggle">
      <span class="glyphicon glyphicon-plus"></span> Create User
    </button>
  </div>

  <div class="panel-body panal-body-container">

    <div class="alert alert-danger" id="delete-user-failed" style="display: none">
      <b>User account deleted request failed please refresh the page !!</b>
    </div><!-- /.alert -->

    <div class="alert alert-warning" id="delete-user-success" style="display: none">
      <b>User account was successfuly deleted !!</b>
    </div><!-- /.alert -->

    <div class="row" id="search-bar">
      <div class="col-sm-4">
        <div class="form-group">
          <label>Name</label>
          <input id="search-name" class="form-control" placeholder="search by name">
        </div><!-- /.form-group -->
      </div><!-- /.col-4 -->
      <div class="col-sm-4">
        <div class="form-group">
          <label>Email</label>
          <input id="search-email" class="form-control" placeholder="search by name">
        </div><!-- /.form-group -->
      </div><!-- /.col-4 -->
      <div class="col-sm-4">
        <div class="form-group">
          <label>Subscrib type</label>
          <select id="search-category" class="form-control" placeholder="search by name">
            <option value="">---</option>
            <option value="technical">Technical account</option>
            <option value="customer">Customer account</option>
          </select>
        </div><!-- /.form-group -->
      </div><!-- /.col-4 -->
    </div><!-- /.row -->

    <table class="table table-striped table-hover" id="users-table">
      <tr id="table-header">
        <th class="text-center">Name</th>
        <th class="text-center">Email</th>
        <th class="text-center">Categoey</th>
        <th class="text-center">Joined</th>
        <th class="text-center" style="width: 150px;">Control</th>
      </tr>
    </table>
  </div><!-- /.panel-body -->
</div><!-- /.panel -->

<!-- Create new user -->
<div class="panel panel-default create-user" style="display: none">
  <div class="panel-heading main-color-bg clearfix">
    <h3 class="panel-title pull-left" style="margin-top:5px;">Create New Account</h3>
    <button type="button" class="pull-right btn btn-default btn-xs table-toggle" data-target=".create-user">
      <span class="glyphicon glyphicon-remove" data-target=".create-user"></span> close
    </button>
  </div>

  <div class="panel-body">
      <!-- message alwer -->
      <div class="alert alert-success" id="create-user-sucees" style="display: none">
        <b>A new account was created successfuly !!</b>
      </div><!-- /.alert -->

      <form id="createUserForm">
        <div class="form-group">
          <label>Category</label>
          <select id="category" name="category" class="form-control form-field" style="padding: 0 5px" type="text" !required="!required">
            <option value="">-- select option --</option>
            <option value="technical">Technical account</option>
            <option value="customer">Customer account</option>
          </select>

        </div><!-- /.form-group -->

        <div class="form-group">
          <label>Name</label>
          <input id="name" name="name" class="form-control form-field" style="padding: 0 5px" type="text" !required="!required">
        </div><!-- /.form-group -->

        <div class="form-group">
          <label>Email</label>
          <input id="email" name="email" class="form-control form-field" style="padding: 0 5px" type="email" !required="!required">
        </div><!-- /.form-group -->

        <div class="form-group">
          <label>Passwornd</label>
          <input id="password" name="password" class="form-control form-field" style="padding: 0 5px" type="password" !required="!required">
        </div><!-- /.form-group -->

        <div class="form-group">
          <label>Re-Passwornd</label>
          <input id="password_confirm" name="password2" class="form-control form-field" style="padding: 0 5px" type="password" !required="!required">
        </div><!-- /.form-group -->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
  </div><!-- /.panel-body -->
</div><!--/.panel -->


<!-- Edit user -->
<div class="panel panel-default edit-user" style="display: none">
  <div class="panel-heading main-color-bg clearfix">
    <h3 class="panel-title pull-left" style="margin-top:5px;">Edit Account</h3>
    <button type="button" class="pull-right btn btn-default btn-xs table-toggle" data-target=".edit-user">
      <span class="glyphicon glyphicon-remove" data-target=".edit-user"></span> close
    </button>
  </div>

  <div class="panel-body">
      <!-- message alwer -->
      <div class="alert alert-success" id="edit-form-message-box" style="display: none">
        <b>Account was updated successfuly !!</b>
      </div><!-- /.alert -->

      <form id="editUserForm">
        <div class="form-group">
            <input type="hidden" name="id" value="" id="edit-user-form-id">
            <spna id="id"></span>
        </div><!-- /.form-group -->

        <div class="form-group">
          <label>Category</label>
          <select id="edit-category" name="edit-category" class="form-control form-field" style="padding: 0 5px" type="text" !required="!required">
            <option value="">-- select option --</option>
            <option value="technical">Technical account</option>
            <option value="customer">Customer account</option>
          </select>

        </div><!-- /.form-group -->

        <div class="form-group">
          <label>Name</label>
          <input id="edit-name" name="edit-name" class="form-control form-field" style="padding: 0 5px" type="text" !required="!required">
        </div><!-- /.form-group -->

        <div class="form-group">
          <label>Email</label>
          <input id="edit-email" name="edit-email" class="form-control form-field" style="padding: 0 5px" type="email" !required="!required">
        </div><!-- /.form-group -->

        <div class="form-group">
          <label>Passwornd</label>
          <input id="edit-password" name="edit-password" class="form-control form-field" style="padding: 0 5px" type="password" !required="!required">
        </div><!-- /.form-group -->

        <div class="form-group">
          <label>Re-Passwornd</label>
          <input id="edit-password2" name="edit-password2" class="form-control form-field" style="padding: 0 5px" type="password" !required="!required">
        </div><!-- /.form-group -->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
  </div><!-- /.panel-body -->
</div><!--/.panel -->


<script>
  document.addEventListener('DOMContentLoaded', (event) => {

    let DataController  = (function () {
      let getRequest = async function (url) {
        let response = await fetch(url);

        return response.json();
      };

      let postRequest = async function (url, reqData) {
        let response = await fetch(url, {
          method  : 'POST',
          headers : {'Content-Type': 'application/json'},
          body    : JSON.stringify(reqData)
        });

        return response.json()
      }

      return {
        getRequest  : getRequest,
        postRequest : postRequest
      };
    })();

    let UIController    = (function () {
      // All element selectors stored in this object
      let DOM = {
        // main selectors
        spinLoader  : '#loader',
        togglePanle : '.table-toggle',

        // table selectors
        userTable       : '#users-table',
        userTableHeader : '#table-header',
        userRow         : '.user-row',
        searchBar       : '#search-bar',
        searchName      : '#search-name',
        searchEmail     : '#search-email',
        searchCategory  : '#search-category',

        // create user form
        createUserForm  : '#createUserForm',
        name      : '#name',
        email     : '#email',
        category  : '#category',
        password  : '#password',
        password_confirm  : '#password_confirm',
        fieldErr          : '.field-err',
        createUserSuccess : '#create-user-sucees',
        editUserSuccess   : '#edit-form-message-box',

        // edit user form
        editUserForm : '#editUserForm',
        editId       : '#edit-user-form-id',
        editCategory : '#edit-category',
        editName     : '#edit-name',
        editEmail    : '#edit-email',
        editPassword : '#edit-password',
        editPassword2 : '#edit-password2',

        genericError  : '#generic-error',
        deleteUserSuccess :'#delete-user-success',
        deleteUserFailed  : '#delete-user-failed'
      }

      /*
        TogglePanle (element <Object>)
        A function used to play the related animation for all panales toggling
      */
      let togglePanle = function (element) {
        element.addEventListener('click', function (e) {
          let targetPanal = e.target.dataset.target;

          if (targetPanal == null) {
            $('.users-table').slideUp(500);
            $('.create-user').slideDown(500);
          }
          else {
            $(targetPanal).slideUp(500);
            $('.users-table').slideDown();
          }
        });
      }// end :: togglePanle

      /*
        toggleSpinLoader
        A function that it's main rolle is to toggle the spinner load animation
        The function using a static "spinnerFlag" variable
      */
      let spinnerFlag = true;
      function toggleSpinLoader () {
        if (spinnerFlag) {
          $(DOM.spinLoader).show(500);
          spinnerFlag = false;
        } else {
          $(DOM.spinLoader).hide(500);
          spinnerFlag = true;
        }
      }

      /*
        drawUserRow <User-Object>
        A function that take an object and start drawing the user
      */
      let drawUserRow = function (userObject) {
        let userRow =
        `<tr class="text-center user-row" id="user-${userObject.id}">
          <td>${userObject.name}</td>
          <td>${userObject.email}</td>
          <td>${userObject.category}</td>
          <td>${userObject.created_at.split(" ")[0]}</td>
          <td>
            <button class="btn btn-sm btn-primary"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
            <button class="btn btn-sm btn-warning table-toggle" data-user-id="${userObject.id}" data-target=".edit-user">
              <i class="fa fa-pencil-square table-toggle" data-user-id="${userObject.id}" data-target=".edit-user" aria-hidden="true"></i>
            </button>
            <button class="btn btn-sm btn-danger delete-user" data-user-id="${userObject.id}">
              <i class="fa fa-trash delete-user" data-user-id="${userObject.id}" aria-hidden="true"></i>
            </button>
          </td>
        </tr>`;

        $(DOM.userTableHeader).after(userRow);
      }

      /*
        deleteUserRow
        A function used to delete the user row from the table
      */
      let deleteUserRow = function (userId) {
        $('#user-'+userId).remove();
      }

      /*
        showGenerialError
        A function that shows a general error message.
      */
      let showGenerialError = function () {
        $(DOM.genericError).slideDown(500);
      }

      /*
        getUserFields
        A function that used for getting all data from the create user field
      */
      let getUserFields = function () {
        return {
          name      : document.querySelector(DOM.name).value,
          email     : document.querySelector(DOM.email).value,
          category  : document.querySelector(DOM.category).value,
          password  : document.querySelector(DOM.password).value,
          password_confirm : document.querySelector(DOM.password_confirm).value
        }
      }

      /*
        clearUserFields
        A function used clear create user from
      */
      let clearUserFields = function (flag = false) {
        let edit = flag ? 'edit-' : '';
        document.querySelector(DOM.name).value = '';
        document.querySelector(DOM.email).value = '';
        document.querySelector(DOM.category).value = '';
        document.querySelector(DOM.password).value = '';
        document.querySelector(DOM.password_confirm).value = '';

        document.querySelector(DOM.editName).value = '';
        document.querySelector(DOM.editEmail).value = '';
        document.querySelector(DOM.editCategory).value = '';
        document.querySelector(DOM.editPassword).value = '';
        document.querySelector(DOM.editPassword2).value = '';
      }

      /*
        showSuccessMsg
        A function used show success message
      */
      let showSuccessMsg  = function (flag = true) {
        let formType = flag ? DOM.createUserSuccess : DOM.editUserSuccess ;
        $(formType).slideDown(500);

        setTimeout(() => {
          $(formType).slideUp(500);
        }, 3000)
      }

      /*
        deleteUserSuccessMsg
        A function used to show success delete Message
      */
      let deleteUserSuccessMsg = function (flag = true) {
        errMsg = flag ? DOM.deleteUserSuccess : DOM.deleteUserFailed;

        $(errMsg).slideDown(500);

        setTimeout(() => {
          $(errMsg).slideUp(500);
        }, 3000);
      };

      /*
        removeErrMsg
        A function used to remove Error message
      */
      let removeErrMsg = function () {
        console.log('test');
        $(DOM.fieldErr).remove();
      }

      /*
        showUserErrors
        A function used to user fields error
      */
      let showUserErrors = function (errKey, errMsg) {
        let errElement = `
        <div class="alert alert-danger field-err" style="padding: 5px 7px; margin-top: 10px;">
          <span>${errMsg}</span>
        </div>
        `;

        $('#'+errKey).after(errElement);
      }

      /*
        getSearchBarData
        A function used to get search bar data fields
      */
      let getSearchBarData = function () {
        return {
          name     : document.querySelector(DOM.searchName).value,
          email    : document.querySelector(DOM.searchEmail).value,
          category : document.querySelector(DOM.searchCategory).value,
        };
      };

      let putEditFormData = function (user) {
        document.querySelector(DOM.editId).value = user.id;
        document.querySelector(DOM.editCategory).value = user.category;
        document.querySelector(DOM.editName).value = user.name;
        document.querySelector(DOM.editEmail).value = user.email;
        document.querySelector(DOM.editPassword).value = '';
        document.querySelector(DOM.editPassword2).value = '';
      };

      let getEditFormData = function () {
        return {
          id : document.querySelector(DOM.editId).value,
          category : document.querySelector(DOM.editCategory).value,
          name     : document.querySelector(DOM.editName).value,
          email    : document.querySelector(DOM.editEmail).value,
          password          : document.querySelector(DOM.editPassword).value,
          password_confirm  : document.querySelector(DOM.editPassword2).value,
        };
      };

      return {
        DOM : DOM,
        togglePanle       : togglePanle,
        toggleSpinLoader  : toggleSpinLoader,
        drawUserRow       : drawUserRow,
        deleteUserRow     : deleteUserRow,
        showGenerialError : showGenerialError,
        getUserFields     : getUserFields,
        clearUserFields   : clearUserFields,
        showSuccessMsg    : showSuccessMsg,
        deleteUserSuccessMsg : deleteUserSuccessMsg,
        showUserErrors    : showUserErrors,
        removeErrMsg      : removeErrMsg,
        getSearchBarData  : getSearchBarData,
        getEditFormData   : getEditFormData,
        putEditFormData   : putEditFormData,
        getEditFormData   : getEditFormData,
      }
    })();

    let MainController  = (function (dataCtr, uiCtr) {
      let DOMString = uiCtr.DOM;

      let getAllusers = function () {
        uiCtr.toggleSpinLoader();

        // Start fetching data
        dataCtr.getRequest("{{route('users.get')}}").then((res) => {
          if (res.flag) {
            // loop through the list of users
            // draw each user as a row in the table
            res.response.forEach((user) => {
              uiCtr.drawUserRow(user);
            });
          }
          else {
            uiCtr.showGenerialError();
          }// end :: if

          uiCtr.toggleSpinLoader();
        })
        .catch(err => {
          console.log(err);
          uiCtr.showGenerialError();
        });
        // End fetching data
      }// end :: getAllusers

      let panaleToggel = function () {
        document.querySelectorAll(DOMString.togglePanle).forEach((element) => {
          uiCtr.togglePanle(element);
        });

        // for the edit button use propegation
        document.querySelector(DOMString.userTable).addEventListener('click', (e) => {
          if (e.target.classList.contains('table-toggle')) {
            let userId = e.target.dataset.userId;
            let targetPanal = e.target.dataset.target;
            console.log(targetPanal);

            $(targetPanal).slideDown(500);
            $('.users-table').slideUp();

            dataCtr.getRequest(`{{route('users.find')}}?id=${userId}`)
            .then(res => {
              if(res.flag) {
                uiCtr.putEditFormData(res.response);
              }
            });

          }// end :: if
        });
      }// end :: panaleToggel

      let createUser = function () {
        document.querySelector(DOMString.createUserForm).addEventListener('submit', (e) => {
          e.preventDefault();
          // remove old field error & show spinnerLoad
          uiCtr.removeErrMsg();
          uiCtr.toggleSpinLoader();

          // get all user data field
          let data = uiCtr.getUserFields();

          // make a request for creating a new user
          dataCtr.postRequest("{{route('users.store')}}", data)
           .then(res => {

             // if there is an error show the error field
             // else show success message and clean the form
             if (res.flag) {
               uiCtr.clearUserFields();
               uiCtr.showSuccessMsg();
               uiCtr.drawUserRow(res.response);
             }
             else {
               let errorKeys = Object.keys(res.response);
               errorKeys.forEach(key => {
                 uiCtr.showUserErrors(key, res.response[key])
               });
             }

             // remove spinnerLoad
             uiCtr.toggleSpinLoader();
           })
           .catch(err => {
             console.log(err);
             uiCtr.showGenerialError();
           });

          console.log(data);
        });
      }// end :: createUser

      let userSearch = function () {

        function search () {
          // get search bar fields data value
          let data = uiCtr.getSearchBarData();

          // start doing your request
          dataCtr.getRequest(`{{route('users.search')}}?name=${data.name}&email=${data.email}&category=${data.category}`)
          .then((res) => {
            if(res.flag) {
              $(DOMString.userRow).remove();
              res.response.forEach(user => {
                uiCtr.drawUserRow(user);
              });
            }
          })
          .catch(err => {
            console.log(err);
            uiCtr.showGenerialError();
          })
        }// end :: search

        document.querySelector(DOMString.searchBar).addEventListener('keyup' , (e) => {
          search();
        });
        document.querySelector(DOMString.searchBar).addEventListener('change' , (e) => {
          search();
        });
      }// end :: userSearch

      let editUser = function () {
        document.querySelector(DOMString.editUserForm).addEventListener('submit', (e) => {
          e.preventDefault();

          // remove old field error & show spinnerLoad
          uiCtr.removeErrMsg();
          uiCtr.toggleSpinLoader();

          // get all user data field
          let data = uiCtr.getEditFormData();
          console.log(data);
          // make a request for creating a new user
          dataCtr.postRequest("{{route('users.update')}}", data)
           .then(res => {

             // if there is an error show the error field
             // else show success message and clean the form
             if (res.flag) {
               uiCtr.clearUserFields(true);
               uiCtr.showSuccessMsg(false);
               uiCtr.deleteUserRow(res.response.id);
               uiCtr.drawUserRow(res.response);
             }
             else {
               let errorKeys = Object.keys(res.response);
               errorKeys.forEach(key => {
                 uiCtr.showUserErrors('edit-'+key, res.response[key])
               });
             }

             // remove spinnerLoad
             uiCtr.toggleSpinLoader();
           })
           .catch(err => {
             console.log(err);
             uiCtr.showGenerialError();
           });

          console.log(data);
        });
      };

      let deleteUser = function () {
        document.querySelector(DOMString.userTable).addEventListener('click', (e) => {

          if(e.target.classList.contains('delete-user')) {
            let confirm = prompt('To delete this account please enter "delete".');

            if (confirm === 'delete') {
              let userId = e.target.dataset.userId;
              dataCtr.postRequest("{{route('users.delete')}}", {id : userId})
              .then(res => {
                if(res.flag) {
                  uiCtr.deleteUserRow(userId);
                  uiCtr.deleteUserSuccessMsg();
                } else {
                  uiCtr.deleteUserSuccessMsg(false);
                }
              });
            }// end :: inner if
          }// end :: if
        });
      };

      function main () {
        // get all users in the start of the page
        getAllusers();

        // Toggle panale event handler
        panaleToggel();

        // create a new user
        createUser();

        // search user table event handler
        userSearch();

        // edit user
        editUser();

        // delete user request
        deleteUser();

      }// end :: main

      return {
        init : function () {
          main();
        }
      }
    })(DataController, UIController);

    MainController.init();
  });
</script>
@endsection
