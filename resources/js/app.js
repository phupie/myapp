/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery');
require('axios');
window.Vue = require('vue');

import store from "./store/";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('follow-button', require('./components/FollowButton.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
});

import Swal from 'sweetalert2';

window.deleteConfirm = function(formId)
{
    Swal.fire({
        text: '本当に削除してもよろしいですか？',
        showCancelButton: true,
        confirmButtonText: 'OK!',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

window.previewImage = function(obj)
{
	var fileReader = new FileReader();
	fileReader.onload = (function() {
		document.getElementById('preview').src = fileReader.result;
	});
	fileReader.readAsDataURL(obj.files[0]);
}

$(function () {
      $('[data-toggle="tooltip"]').tooltip();
});

//masonry
$(window).on('load',function(){
    $('.grid').masonry({
        itemSelector: '.grid-item',
        percentPosition: true
    });
});

//ネタバレON/OFF
$(function() {
    $("#all_gallery").change(function() {
        // チェックボックスがアクティブなら
        if($(this).prop('checked')) {
            $("#galleries").hide();
            
            $("#all-galleries").fadeIn();
            
            $('.grid').masonry({
                itemSelector: '.grid-item',
                percentPosition: true
            });
        } else {
            $("#all-galleries").hide();
            
            $("#galleries").fadeIn();
            
            $('.grid').masonry({
                itemSelector: '.grid-item',
                percentPosition: true
            });
        }
    });
});

$(function() {
  var $children = $('.children');
  var original = $children.html();

  $('.parent').change(function() {
    var val1 = $(this).val();

    $children.html(original).find('option').each(function() {
      var val2 = $(this).data('val');
      if (val1 != val2) {
        $(this).not('optgroup,.msg').remove();
      }
    });

    if (val1 === '') {
      $children.prop('disabled', true);
    } else {
      $children.prop('disabled', false);
      $('.mute').removeClass('text-muted')
    }

  });
});