// Generated by CoffeeScript 1.10.0
(function() {
  $(function() {
    var confirm_message, curParentId, fileToMove, folderToMove, getTree, getTreeFiles;
    confirm_message = 'Вы уверены?';
    if ($('body').attr('class') === 'lang_en') {
      confirm_message = 'Are you sure?';
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $(".admin_delete").on('click', function() {
      var url;
      url = $(this).attr("href");
      if (confirm(confirm_message)) {
        $.ajax({
          url: url,
          type: 'post',
          data: {
            _method: 'delete'
          },
          success: function(data) {
            return window.location.reload();
          }
        });
      }
      return false;
    });
    $('.context').contextmenu();
    $("#folders").on('click', '.delete_folder', function() {
      var url;
      url = $(this).attr("data-url");
      if (confirm(confirm_message)) {
        $.ajax({
          url: url,
          type: 'post',
          data: {
            _method: 'delete'
          },
          success: function(data) {
            return window.location.reload();
          }
        });
      }
      return false;
    });
    $("#folders").on('click', '.rename_folder', function() {
      var id;
      id = $(this).attr('data-id');
      $("#folder_" + id + " .folder_name").hide();
      $("#folder_" + id + " .folder_rename_input").show();
      $("#context-menu-" + id).hide();
      return false;
    });
    $("#folders").on('click', '.folder_rename_input', function(event) {
      event.stopPropagation();
      return false;
    });
    $(document).on('blur', '.folder_rename_input', function(e) {
      return $(document).click();
    });
    $(document).on('click', function(e) {
      if (!$(e.target).is('.folder_rename_input')) {
        $("body").find(".folder_rename_input").not(":hidden").each(function() {
          var $this, id, method, name, parent_id, url;
          id = $(this).attr('data-id');
          name = $(this).val();
          url = $(this).attr('data-url');
          method = $(this).attr('data-method');
          parent_id = $('#folders').attr('data-parent-id');
          $this = $(this);
          return $.ajax({
            url: url,
            type: 'post',
            data: {
              _method: method,
              id: id,
              name: name,
              description: name,
              parent_id: parent_id
            },
            success: function(data) {
              $this.parents('.folder_container').replaceWith(data);
              return $('.context').contextmenu();
            }
          });
        });
        $("#folders .folder_rename_input").hide();
        return $('#folders .folder_name').show();
      }
    });
    $(".add_folder").on('click', function() {
      var html;
      html = $('#clone_folder').html();
      $('#folders').append(html);
      $('#folders .folder_container').last().find('input').focus();
      return false;
    });
    folderToMove = 0;
    $('#folders').on('click', '.move_folder', function() {
      var id;
      id = $(this).attr('data-id');
      folderToMove = id;
      $("#context-menu-" + id).hide();
      getTree();
      return false;
    });
    fileToMove = 0;
    $('#folders').on('click', '.move_file', function() {
      var id;
      id = $(this).attr('data-id');
      fileToMove = id;
      $("#context-menu-" + id).hide();
      getTreeFiles();
      return false;
    });
    curParentId = $('#folders').attr('data-parent-id');
    getTree = function() {
      return $.ajax({
        url: $('#folders').attr('data-get-tree-url'),
        type: 'get',
        dataType: 'json'
      }).done(function(data) {
        $('#tree').treeview({
          data: data,
          onNodeSelected: function(event, data) {
            return curParentId = data.id;
          }
        });
        return $('#treeModal').modal('show');
      });
    };
    $('.select_category').click(function() {
      $.ajax({
        url: "/folders/" + folderToMove + "/edit",
        type: 'post',
        data: {
          _method: 'put',
          id: folderToMove,
          parent_id: curParentId,
          is_ajax: 'Y'
        }
      }).done(function(data) {
        return window.location.reload();
      });
      return false;
    });
    getTreeFiles = function() {
      return $.ajax({
        url: $('#folders').attr('data-get-tree-url'),
        type: 'get',
        dataType: 'json'
      }).done(function(data) {
        $('#treeFiles').treeview({
          data: data,
          onNodeSelected: function(event, data) {
            return curParentId = data.id;
          }
        });
        return $('#treeFilesModal').modal('show');
      });
    };
    $('.select_category_for_file').click(function() {
      $.ajax({
        url: "/files/" + fileToMove + "/edit",
        type: 'post',
        data: {
          _method: 'put',
          id: fileToMove,
          folder_id: curParentId,
          is_ajax: 'Y'
        }
      }).done(function(data) {
        return window.location.reload();
      });
      return false;
    });
    $('.add_file').click(function() {
      var $this;
      $this = $(this);
      $.ajax({
        url: $this.attr('data-url'),
        type: 'get'
      }).done(function(data) {
        $('#file_add_contaier').html(data);
        return $('#filesModal').modal('show');
      });
      return false;
    });
    $('.add_multiple_files').click(function() {
      var $this;
      $this = $(this);
      $.ajax({
        url: $this.attr('data-url'),
        type: 'get'
      }).done(function(data) {
        var fileList, i, myDropzone;
        fileList = new Array();
        i = 0;
        $('#add_multiple_files_contaier').html(data);
        $('#multiple_files_modal').modal('show');
        $('#multiple_files_modal input[name=folder_id]').val($('#folders').attr('data-parent-id'));
        return myDropzone = new Dropzone("#dropzone", {
          url: "/files/multi",
          addRemoveLinks: true,
          maxFilesize: 1000,
          parallelUploads: 1,
          previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-image\"><img data-dz-thumbnail /></div>\n  <div class=\"dz-details\">\n    <div class=\"dz-size\"><span data-dz-size></span></div>\n    <div class=\"dz-filename\"><input type=\"text\" name=\"file_name\" class=\"file_rename_multi\" data-dz-name /></div>\n  </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n  <div class=\"dz-success-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Check</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n        <path d=\"M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" stroke-opacity=\"0.198794158\" stroke=\"#747474\" fill-opacity=\"0.816519475\" fill=\"#FFFFFF\" sketch:type=\"MSShapeGroup\"></path>\n      </g>\n    </svg>\n  </div>\n  <div class=\"dz-error-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Error</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n        <g id=\"Check-+-Oval-2\" sketch:type=\"MSLayerGroup\" stroke=\"#747474\" stroke-opacity=\"0.198794158\" fill=\"#FFFFFF\" fill-opacity=\"0.816519475\">\n          <path d=\"M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" sketch:type=\"MSShapeGroup\"></path>\n        </g>\n      </g>\n    </svg>\n  </div>\n</div>",
          renameFilename: function(name) {
            return name;
          },
          init: function() {
            this.on("success", function(file, serverFileName) {
              fileList[i] = {
                serverFileName: serverFileName,
                fileName: file.name,
                fileId: i
              };
              i++;
              $(file.previewElement.querySelectorAll("[data-dz-name]")).keyup(function() {
                var val;
                val = $(this).val();
                if (val.length >= 1 && val !== " ") {
                  return $.ajax({
                    url: "/files/" + serverFileName + "/edit",
                    type: 'post',
                    data: {
                      _method: 'put',
                      description: val
                    },
                    success: function(data) {
                      return console.log(data);
                    }
                  });
                }
              });
              return $(file.previewElement.querySelectorAll("[data-dz-name]")).keyup();
            });
            return this.on("removedfile", function(file) {
              var f_file, j, len, rmvFile;
              rmvFile = "";
              for (j = 0, len = fileList.length; j < len; j++) {
                f_file = fileList[j];
                if (f_file.fileName === file.name) {
                  rmvFile = f_file.serverFileName;
                }
              }
              if (rmvFile) {
                return $.ajax({
                  url: "/files/" + rmvFile,
                  type: 'post',
                  data: {
                    _method: 'delete'
                  },
                  success: function(data) {
                    return console.log(data);
                  }
                });
              }
            });
          }
        });
      });
      return false;
    });
    $(document).on('click', '.save_file', function() {
      if ($("#file").val() === '') {
        $('#file-errors').show();
        return false;
      }
      if ($("#file_name").val() === '') {
        $('#file-errors').show();
        return false;
      }
      $('#file-errors').hide();
      $('#file_upload_form input[name=folder_id]').val($('#folders').attr('data-parent-id'));
      $('#file_upload_form').submit();
      return false;
    });
    $('body').on('click', '.update_file', function() {
      var $this, id;
      id = $(this).attr('data-id');
      $("#context-menu-" + id).hide();
      $this = $(this);
      $.ajax({
        url: $this.attr('data-url'),
        type: 'get'
      }).done(function(data) {
        $('#file_add_contaier').html(data);
        return $('#filesModal').modal('show');
      });
      return false;
    });
    $('body').on('click', '.update_folder', function() {
      var $this, id;
      id = $(this).attr('data-id');
      $("#context-menu-" + id).hide();
      $this = $(this);
      $.ajax({
        url: $this.attr('data-url'),
        type: 'get'
      }).done(function(data) {
        $('#folder_update_container').html(data);
        return $('#folderModal').modal('show');
      });
      return false;
    });
    return $('body').on('click', '#multiple_files_modal', function(e) {
      var container, dz_details;
      container = $("#multiple_files_modal").find('.modal-dialog');
      dz_details = $('.dz-details');
      if (!container.is(e.target) && container.has(e.target).length === 0 && dz_details.length) {
        return window.location.reload();
      }
    });
  });

}).call(this);

//# sourceMappingURL=script.js.map
