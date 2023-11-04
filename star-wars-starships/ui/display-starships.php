<?php

function display_starships()
{
?>
  <div class="sw-popup" id="sw-popup">
    <div id="close">X</div>
    <div class="loader" id="sw-loader"></div>
    <table id="sw-table">
      <thead>
        <tr>
          <td>Name</td>
          <td>Starship Class</td>
          <td>Crew</td>
          <td>Cost in Credits</td>
        </tr>
      </thead>
      <tbody id="table-body">

      </tbody>
      <div class="buttons" id="sw-buttons">
        <button class="btn" id="btn-prev">prev</button>
        <button class="btn" id="btn-next">next</button>
      </div>
    </table>
  </div>
  <button class="main-btn" id="main-btn">Starshipedia</button>
<?php
}
