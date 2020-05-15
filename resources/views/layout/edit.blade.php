<form method="POST" action="{{ url('/edit',$Id)}}">
  {{ csrf_field() }}
  <?php $data=json_decode($data,true)?>
  <button class="btn btn-primary float-right">修改</button>
  <h5 class='h5color'>數據期間</h5>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="period">年月</label>
      <input type="hidden" name="Id" value="{{ $Id }}">
      <input type="text" name="period" class="form-control" id="period" placeholder="{{ $data[0]['Period']}}" disabled>
    </div>
  </div>
  <h5 class='h5color'>寬頻上網-(有線)</h5>
  <div class="form-row">
    <div class="form-group col-6 col-md-3">
      <label for="BADSL">ADSL</label>
      <input type="number" name="BADSL" class="form-control" id="BADSL" value="{{ $data[0]['B_ADSL']}}">
    </div>
    <div class="form-group col-6 col-md-3">
      <label for="BCableModem">Cable_Modem</label>
      <input type="number" name="BCableModem" class="form-control" id="BCableModem"
        value="{{ $data[0]['B_Cable_Modem']}}">
    </div>
    <div class="form-group col-6 col-md-3">
      <label for="BFTTX">FTTX</label>
      <input type="number" name="BFTTX" class="form-control" id="BFTTX" value="{{ $data[0]['B_FTTX']}}">
    </div>
    <div class="form-group col-6 col-md-3">
      <label for="BLeasedLine">Leased_Line</label>
      <input type="number" name="BLeasedLine" class="form-control" id="BLeasedLine"
        value="{{ $data[0]['B_Leased_Line']}}">
    </div>
  </div>
  <h5 class='h5color'>寬頻上網-(無線)</h5>
  <div class="form-row">
    <div class="form-group col-6 col-md-4">
      <label for="WBWLAN">行動寬頻_PWLAN</label>
      <input type="number" name="WBWLAN" class="form-control" id="WBWLAN" value="{{ $data[0]['WB_PWLAN']}}">
    </div>
    <div class="form-group col-6 col-md-4">
      <label for="WB3G">行動寬頻_3G數據</label>
      <input type="number" name="WB3G" class="form-control" id="WB3G" value="{{ $data[0]['WB_3GDate']}}">
    </div>
    <div class="form-group col-6 col-md-4">
      <label for="WB4G">行動寬頻_4G數據</label>
      <input type="number" name="WB4G" class="form-control" id="WB4G" value="{{ $data[0]['WB_4GDate']}}">
    </div>
  </div>
  <h5 class='h5color'>行動上網</h5>
  <div class="form-row">
    <div class="form-group col-6 col-md-3">
      <label for="M3GDataCard">3GDataCard</label>
      <input type="number" name="M3GDataCard" class="form-control" id="M3GDataCard"
        value="{{ $data[0]['M_3GDataCard']}}">
    </div>
    <div class="form-group col-6 col-md-3">
      <label for="M3GPhone">3GPhone</label>
      <input type="number" name="M3GPhone" class="form-control" id="M3GPhone" value="{{ $data[0]['M_3GPhone']}}">
    </div>
    <div class="form-group col-6 col-md-3">
      <label for="M4GDataCard">4DataCard</label>
      <input type="number" name="M4GDataCard" class="form-control" id="M4GDataCard"
        value="{{ $data[0]['M_4GDataCard']}}">
    </div>
    <div class="form-group col-6 col-md-3">
      <label for="M4GPhone">4GPhone</label>
      <input type="number" name="M4GPhone" class="form-control" id="M4GPhone" value="{{ $data[0]['M_4GPhone']}}">
    </div>
  </div>


</form>