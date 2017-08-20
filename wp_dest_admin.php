<?php
/**
 * What is the purpose of this file?
 */

?>
<div class="wrap">
  <h2>WP Destinations</h2>

  <div id="message" class="updated below-h2">
    <p>Content updated successfully</p>
  </div>
  <div class="metabox-holder">
    <div class="postbox">
      <h3><strong>Hello World Option</strong></h3>
      <form method="post" action="">
        <table class="form-table">
          <tr>
            <td>
              <input type="text" name="hellow-world" value="<?php if(get_option('hellow-world')){echo get_option('hellow-world');}?>" style="width:350px;" placeholder="Enter some text here" />
            </td>
          </tr>
          <tr>
            <td>
              <input type="text" name="hellow-world" value="<?php if(get_option('hellow-world')){echo get_option('hellow-world');}?>" style="width:350px;" placeholder="Enter some text here" />
            </td>
          </tr>
          <tr>
            <td style="padding-top:10px;  padding-bottom:10px;">
              <input type="submit" name="wpc-hw-submit" value="Save changes" class="button-primary" />
            </td>
          </tr>
        </table>
      </form>
      <div id="map" style="width: 300px; height: 300px;"></div>
    </div>
  </div>
</div>