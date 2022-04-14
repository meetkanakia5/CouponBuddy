   {{-- text Editor --}}
   {{-- <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>  --}}
   
   <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>

   {{-- // Tiny MCE Free plugin --}}
   {{-- <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=es9zowp4gqnwpr6qphgqvjv60qrg70m990u4ri5d01b8y5x4"></script>  --}}

   <script type="text/javascript">
      // tinymce.init({
         
      //    selector: ".editor",  // change this value according to your HTML
      //    //selector: "textarea",
         
      //    height: "480",
         
      //    plugins: ['lists code', 'paste', 'image code'],
      //    //plugins: 'paste', 'image code',
      //    //plugins: 'image code',

      //    toolbar: "formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | addcomment | undo redo | link image | code",
      //    //toolbar: 'undo redo | link image | code',

      //    powerpaste_allow_local_images: true,
      //    powerpaste_word_import: 'prompt',
      //    powerpaste_html_import: 'prompt',
      //    image_title: true,
      //    convert_urls : false,
      //    fix_list_elements : true,
      //    automatic_uploads: true,
      //    file_picker_types: 'image',
      //    file_picker_callback: function (cb, value, meta) {

      //       var input = document.createElement('input');
      //       input.setAttribute('type', 'file');
      //       input.setAttribute('accept', 'image/*');

      //       /*
      //          Note: In modern browsers input[type="file"] is functional without
      //          even adding it to the DOM, but that might not be the case in some older
      //          or quirky browsers like IE, so you might want to add it to the DOM
      //          just in case, and visually hide it. And do not forget do remove it
      //          once you do not need it anymore.
      //       */

      //       input.onchange = function () {
      //          var file = this.files[0];

      //          var reader = new FileReader();
      //          reader.onload = function () {
      //          /*
      //             Note: Now we need to register the blob in TinyMCEs image blob
      //             registry. In the next release this part hopefully won't be
      //             necessary, as we are looking to handle it internally.
      //          */
      //          var id = 'blobid' + (new Date()).getTime();
      //          var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
      //          var base64 = reader.result.split(',')[1];
      //          var blobInfo = blobCache.create(id, file, base64);
      //          blobCache.add(blobInfo);

      //          /* call the callback and populate the Title field with the file name */
      //          cb(blobInfo.blobUri(), { title: file.name });
      //          };
      //          reader.readAsDataURL(file);
      //       };

      //       input.click();
      //    }
      // });

      CKEDITOR.replace( 'editor1', {
         height:400,
         filebrowserUploadUrl: "{{ route('backend.ck-image-upload') }}",
         filebrowserUploadMethod: "form",
         //customConfig: "{{ asset('assets/ckcustom/ck_config.js') }}",
      });
      
   </script>