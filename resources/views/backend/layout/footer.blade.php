        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-end">
                        <p class="mb-0">
                            &copy; {{$copyright_year}} - <a href="{{route('admin_dashboard')}}" class="text-muted">{{$site_name}}</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace('editor', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
             { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
});

</script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function(){
        basic();
        $('#item').select2();
    });

    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }

    function basic(){
        $("input").attr("autocomplete", "off");
        $("textarea").attr("autocomplete", "off");
        $("input[type=password]").attr("autocomplete", "new-password");
        $(".numeric").bind("keypress", function (e) {
            var keyCode = e.which ? e.which : e.keyCode;
            if (!((keyCode >= 48 && keyCode <= 57) || keyCode == 46)) {
                return false;
            }
        });
        $(".num_only").bind("keypress", function (e) {
            var keyCode = e.which ? e.which : e.keyCode;
            if (!((keyCode >= 48 && keyCode <= 57))) {
                return false;
            }
        });
    }
    function PreviewImage(no) 
    {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);
        oFReader.onload = function (oFREvent) 
        {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
            $('#uploadPreview'+no).removeClass('npPreviewImage');
            $('#uploadPreview'+no).addClass('previewImage');
        };
    }
</script>
@yield('javascript')
</body>

</html>