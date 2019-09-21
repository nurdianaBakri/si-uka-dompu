                    
                <div class="row">
                  <div class="col-md-9"> 
                    <div class="form-group has-feedback">
                      <div id="Username" style="color: red"></div>
                      <input type="number" class="form-control" placeholder="masukkan NIP/NIK/nama" id="keyword" value="">
                    </div>
                  </div>
                  <div class="col-md-3">
                      <button class="btn btn-primary" id="submit_cari">Cari</button> 
                  </div>
                </div> 

                <div class="hasil"></div>

                  <script type="text/javascript">
                    $(document).ready(function(){
                      $("#submit_cari").click(function(){
                        var keyword = $("#keyword").val();
                          $.ajax({ 
                              url: '<?php echo base_url()."admin/User/cari" ?>',
                              data: {
                                keyword:keyword,
                              },
                              type: 'post'
                          }).done(function(responseData) {
                              $('.hasil').html(responseData);
                          }).fail(function() {
                              console.log('Failed');
                          });
                      }); 
                  }); 
                  </script>