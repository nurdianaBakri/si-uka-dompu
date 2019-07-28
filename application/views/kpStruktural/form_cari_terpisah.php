                    
                <div class="row">
                  <div class="col-xs-9"> 
                    <div class="form-group has-feedback">
                      <div id="Username" style="color: red"></div>
                      <input type="number" class="form-control" placeholder="masukkan NIP atau NIK" name="nip" id="nikAtauNip" value="">
                    </div>
                  </div>
                  <div class="col-xs-3">
                      <button class="btn btn-primary" id="submit_cari">Cari</button> 
                  </div>
                </div> 

                <div class="hasil"></div>

                  <script type="text/javascript">
                    $(document).ready(function(){
                      $("#submit_cari").click(function(){
                        var nikAtauNip = $("#nikAtauNip").val();
                          $.ajax({ 
                              url: '<?php echo base_url()."kpRegular/searchPns/" ?>',
                              data: {
                                nikAtauNip:nikAtauNip,
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