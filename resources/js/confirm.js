import Swal from 'sweetalert2';

    $('#delete').on('click', function(e) {
        e.preventDefault();
        var form = $('form');
    
        swal.fire({
            title: "本当に削除しますか?"
            ,icon: "warning"
            ,showCancelButton: true
            ,confirmButtonColor: "#DD6B55"
            ,confirmButtonText: "削除します!"
            ,position : 'center'
            ,closeOnConfirm: false
            ,allowEscapeKey: true //Escボタン
            ,allowOutsideClick : true //枠外クリック
            ,showCloseButton : true   //閉じるボタン
    
        }).then(function(result) { //←この行の記述を修正した結果改善された
    
            if (result.value) {
    
                form.submit();
    
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Successfully Deleted!',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        });
    });