var $uploadCrop,
    $uploadCropHead,
    rawImg,
    imageId;

function readFile(input, modalId, modalBodyId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(modalBodyId).addClass('ready');
            $(modalId).modal('show');
            rawImg = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
//ヘッダー画像
if ($(window).width() > 768) {
  // PC表示の時の処理
    $uploadCropHead = $('#upload-demo-head').croppie({
        viewport: {
            width: 540,
            height: 180,
        },
        boundary: {
            width: 600,
            height: 180
        },
        showZoomer: false,
        enableOrientation: true
    });
} else {
    $uploadCropHead = $('#upload-demo-head').croppie({
        viewport: {
            width: 270,
            height: 90,
        },
        boundary: {
            width: 300,
            height: 90
        },
        showZoomer: false,
        enableOrientation: true
    });
}

$('#cropImagePop-head').on('shown.bs.modal', function () {
    $uploadCropHead.croppie('bind', {
        url: rawImg
    }).then(function () { });
});

$('.image-head').on('change', function () {
    imageId = $(this).data('id');
    $('#cancelCropBtn-head').data('id', imageId);
    readFile(this, '#cropImagePop-head', '#upload-demo-head');
    $(this).val('');
});

$('#cropImageBtn-head').on('click', function (ev) {
    $uploadCropHead.croppie('result', {
        type: 'base64',
        format: 'jpg',
        backgroundColor: '#fff',
        size: { width: 1500, height: 500 }
    }).then(function (resp) {
        $('#image-output-head').attr('src', resp);
        $('#cropImage-head').val(resp);
        $('#cropImagePop-head').modal('hide');
    });
});
//プロフィール画像
if ($(window).width() > 768) {
  // PC表示の時の処理
    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 300,
            height: 300,
            type: 'circle'
        },
        boundary: {
            width: 600,
            height: 600
        },
        showZoomer: false,
        enableOrientation: true
    });
} else {
    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 100,
            height: 100,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        },
        showZoomer: false,
        enableOrientation: true
    });
}

$('#cropImagePop').on('shown.bs.modal', function () {
    $uploadCrop.croppie('bind', {
        url: rawImg
    }).then(function () { });
});

$('.image').on('change', function () {
    imageId = $(this).data('id');
    $('#cancelCropBtn').data('id', imageId);
    readFile(this, '#cropImagePop', '#upload-demo');
    $(this).val('');
});

$('#cropImageBtn').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'base64',
        format: 'jpg',
        backgroundColor: '#fff',
        size: { width: 200, height: 200 }
    }).then(function (resp) {
        $('#image-output').attr('src', resp);
        $('#cropImage').val(resp);
        $('#cropImagePop').modal('hide');
    });
});