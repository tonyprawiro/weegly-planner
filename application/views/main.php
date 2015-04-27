<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="favicon.ico">-->

    <title>Planner</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/jumbotron.css" rel="stylesheet">
    <link href="/css/plan.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <link href="/js/pickadate/themes/default.css" rel="stylesheet">
    <link href="/js/pickadate/themes/default.date.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Planner</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#" id="loading"></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="active"></a></li>
            <li class="prevweek"></li>
            <li class="currweek active"></li>
            <li class="nextweek"></li>
            <li><a href="/index.php/account/logout">Logout</a></li>
          </ul>

        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-3" data-date="">
          <h4 class="day1">Monday</h4>
          <input type="text" class="form-control newitem" id="inp-1" name="inp-1" data-forlist="sortable1" placeholder="Type new item, then press Enter" />
          <ul class="sortable1 connectedlist">
          </ul>
        </div>
        <div class="col-md-3" data-date="">
          <h4 class="day2">Tuesday</h4>
          <input type="text" class="form-control newitem" id="inp-2" name="inp-2" data-forlist="sortable2" placeholder="Type new item, then press Enter" />
          <ul class="sortable2 connectedlist">
          </ul>
       </div>
        <div class="col-md-3" data-date="">
          <h4 class="day3">Wednesday</h4>
          <input type="text" class="form-control newitem" id="inp-3" name="inp-3" data-forlist="sortable3" placeholder="Type new item, then press Enter" />
          <ul class="sortable3 connectedlist">
          </ul>
        </div>
        <div class="col-md-3" data-date="">
          <h4 class="day4">Thursday</h4>
          <input type="text" class="form-control newitem" id="inp-4" name="inp-4" data-forlist="sortable4" placeholder="Type new item, then press Enter" />
          <ul class="sortable4 connectedlist">
          </ul>
        </div>
        <div style="clear:both"></div>
        <div class="col-md-3" data-date="">
          <h4 class="day5">Friday</h4>
          <input type="text" class="form-control newitem" id="inp-5" name="inp-5" data-forlist="sortable5" placeholder="Type new item, then press Enter" />
          <ul class="sortable5 connectedlist">
          </ul>
        </div>
        <div class="col-md-3" data-date="">
          <h4 class="day6">Saturday</h4>
          <input type="text" class="form-control newitem" id="inp-6" name="inp-6" data-forlist="sortable6" placeholder="Type new item, then press Enter" />
          <ul class="sortable6 connectedlist">
          </ul>
       </div>
        <div class="col-md-3" data-date="">
          <h4 class="day7">Sunday</h4>
          <input type="text" class="form-control newitem" id="inp-7" name="inp-7" data-forlist="sortable7" placeholder="Type new item, then press Enter" />
          <ul class="sortable7 connectedlist">
          </ul>
        </div>
        <div class="col-md-3" data-date="">
          <h4 class="day0">KIV</h4>
          <input type="text" class="form-control newitem" id="inp-0" name="inp-0" data-forlist="sortable0" placeholder="Type new item, then press Enter" />
          <ul class="sortable0 connectedlist">
          </ul>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Party Goodie Bag <?php echo date('Y'); ?></p>
      </footer>
    </div> <!-- /container -->

    <div id="popupcontent" class="well entrypopup">
        <p>
          <input type="text" class="form-control inp-itemname" id="inp-itemname" name="inp-itemname">
        </p>
        <p align="center">
          Date: <input type="text" class="form-control inp-itemdate" id="inp-itemdate" name="inp-itemdate">
          Move to:
          <button class="btn btn-sm btn-default">Prev week</button>
          <button class="btn btn-sm btn-default">Next week</button>
        </p>
        <p align="center">
          <button class="btn btn-sm btn-default">Mon</button>
          <button class="btn btn-sm btn-default">Tue</button>
          <button class="btn btn-sm btn-default">Wed</button>
          <button class="btn btn-sm btn-default">Thu</button>
          <button class="btn btn-sm btn-default">Fri</button>
          <button class="btn btn-sm btn-default">Sat</button>
          <button class="btn btn-sm btn-default">Sun</button>
          <button class="btn btn-sm btn-default">KIV</button>
        </p>
        <p>
          <span style="margin-top: 3px;">
              Importance:
              <input type="radio" class="select-importance-high" name="importance" value="importance-high"> High
              <input type="radio" class="select-importance-normal" name="importance" value="importance-normal"> Normal
              <input type="radio" class="select-importance-low" name="importance" value="importance-low"> Low
          </span>
          <button class="mark-as-done btn btn-sm btn-default pull-right">Mark as done</button>
        </p>
        <p>
          <br />
          <button class="btn btn-sm btn-danger btndeleteentry">Delete</button>
          <span class="pull-right">
          <button class="btn btn-sm btn-default btncancel">Cancel</button>
          <button class="btn btn-sm btn-default btnsaveentry">Save</button>
          </span>
        </p>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery-1.11.1.js"></script>
    <script src="/js/jquery-1.11.1-ui.js"></script>
    <!--<script src="/js/jquery.ui.touch-punch.min.js"></script>-->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.popupoverlay.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
    <script src="/js/pickadate/picker.js"></script>
    <script src="/js/pickadate/picker.date.js"></script>
    <script>
    var CurrentWeek = "";
    var PreviousWeek = "";
    var NextWeek = "";
    var isProcessingQueue = false;
    var Entries = new Array();
    var Queue = new Array();
    var wd;
    var datepickerobj;

    function setLoading() {
      isProcessingQueue = true;
      $('#loading').html('<img src="/img/loading.gif" width="20" /> Loading...');
    }

    function unsetLoading() {
      isProcessingQueue = false;
      $('#loading').html('');
    }

    function newrandomid(prefix) {
      return prefix + Math.floor((Math.random() * 1000000) + 1000000);
    }

    function navigateweek(d) {

      Queue.push(function(){
        $.ajax({
          url: '/index.php/rpc/navweek/' + d,
          type: 'POST',
          data: {entries: ''},
        })
        .done(function(data, textStatus, jqXHR) {
          if(data=='-1') { location.href = '/index.php/account/logout'; } else {
            reflectentries(data);
            unsetLoading();
          }
        })
        .fail(function() {
          console.log("error");
        });
        
      });

    }

    function reflectentry() {
      $('.inp-itemname').val($('.highlighted').text());
      datadate = $('.highlighted').parent().parent().attr('data-date');
      if(datadate.length>0) {
        datepickerobj.set('select', datadate, {format: 'd mmm, yyyy'});        
      } else {
        datepickerobj.clear();
      }
      if($('.highlighted').hasClass('statusdone')) {
        $('.mark-as-done').removeClass('btn-default');
        $('.mark-as-done').addClass('btn-success');
      } else {
        $('.mark-as-done').removeClass('btn-success');
        $('.mark-as-done').addClass('btn-default');
      }
      if($('.highlighted').hasClass('importance-high')) {
        $('.select-importance-high').prop('checked', true);
        $('.select-importance-normal').prop('checked', false);
        $('.select-importance-low').prop('checked', false);
      }
      if($('.highlighted').hasClass('importance-normal')) {
        $('.select-importance-high').prop('checked', false);
        $('.select-importance-normal').prop('checked', true);
        $('.select-importance-low').prop('checked', false);
      }
      if($('.highlighted').hasClass('importance-low')) {
        $('.select-importance-high').prop('checked', false);
        $('.select-importance-normal').prop('checked', false);
        $('.select-importance-low').prop('checked', true);
      }
    }

    function updateentry() {

        Queue.push(function(){
          $.ajax({
            url: '/index.php/rpc/updentry/' + $('.highlighted').attr('id'),
            type: 'POST',
            data: {              
              item_name: $('.inp-itemname').val(),
              item_date: datepickerobj.get('select', 'yyyy-mm-dd'),
              item_statusdone: $('.mark-as-done').hasClass('btn-success') ? 1 : 0,
              item_importance: $('.select-importance-high').prop('checked') ? '100' : ($('.select-importance-normal').prop('checked') ? '10' : '1'),
            },
          })
          .done(function(data, textStatus, jqXHR) {
            $('.connectedlist li').removeClass('highlighted');
            $('#popupcontent').popup('hide');
            if(data=='-1') { location.href = '/index.php/account/logout'; } else {
              reflectentries(data);
              unsetLoading();
            }
            //recapentries(true);
          })
          .fail(function() {
            console.log("error");
          });
          
        });

    }

    function deleteentry() {

      Queue.push(function(){
        $.ajax({
          url: '/index.php/rpc/delentry/' + $('.highlighted').attr('id'),
          type: 'GET',
        })
        .done(function(data, textStatus, jqXHR) {
          $('.connectedlist li').removeClass('highlighted');
          $('#popupcontent').popup('hide');
          if(data=='-1') { location.href = '/index.php/account/logout'; } else {
            reflectentries(data);
            unsetLoading();
          }
        })
        .fail(function() {
          console.log("error");
        });
        
      });

    }

    function reflectentries(data) {
      var weeglydata = JSON.parse(data);
      wd = weeglydata;
      var isodate = weeglydata.navdate.split('-');
      var monthnames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      var weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

      todayobj = new Date();

      isodateobj = new Date(isodate[0]*1, isodate[1]*1 - 1, isodate[2]*1 );

      CurrentWeek = isodateobj.getDate() + '/' + (isodateobj.getMonth()+1) + '/' + isodateobj.getFullYear();
      $('.currweek').html('<a href="#">' + CurrentWeek + '</a>');

      tmp = new Date(isodate[0]*1, isodate[1]*1 - 1, isodate[2]*1 );
      tmp.setDate(isodateobj.getDate()-7);
      PreviousWeek = tmp.getFullYear() + '-' + (tmp.getMonth()+1) + '-' + tmp.getDate();
      $('.prevweek').html('<a href="#" class="prevweeklink">' + tmp.getDate() + '/' + (tmp.getMonth()+1) + '/' + tmp.getFullYear() + ' &laquo;</a>');
      $('.prevweeklink').unbind('click');
      $('.prevweeklink').bind('click', function(){ navigateweek(PreviousWeek); });

      tmp = new Date(isodate[0]*1, isodate[1]*1 - 1, isodate[2]*1 );
      tmp.setDate(isodateobj.getDate()+7);
      NextWeek = tmp.getFullYear() + '-' + (tmp.getMonth()+1) + '-' + tmp.getDate();
      $('.nextweek').html('<a href="#" class="nextweeklink">&raquo; ' + tmp.getDate() + '/' + (tmp.getMonth()+1) + '/' + tmp.getFullYear() + '</a>');
      $('.nextweeklink').unbind('click');
      $('.nextweeklink').bind('click', function(){ navigateweek(NextWeek); });

      $('.col-md-3').removeClass('today');

      for(var i=0; i<=7; i++) {

        if(i>0) { // KIV don't do this

          tmp = new Date(isodate[0]*1, isodate[1]*1 - 1, isodate[2]*1 );
          tmp.setDate(isodateobj.getDate()+i-1);

          if(tmp.toDateString() == todayobj.toDateString()) {
            $('.day' + i).parent().addClass('today');
          }

          $('.day' + i).parent().attr('data-date', tmp.getDate() + ' ' + monthnames[tmp.getMonth()] + ', ' + tmp.getFullYear());

          $('.day' + i).html(weekdays[tmp.getDay()] + ' ' + tmp.getDate() + '/' + (tmp.getMonth()+1) + '/' + tmp.getFullYear());
        }

        $('.sortable' + i).html('');

        if(typeof weeglydata.weekitems[i] != 'undefined') {
          for(var t=0; t<weeglydata.weekitems[i].length; t++) {
            $('.sortable' + i).append('<li id="' + weeglydata.weekitems[i][t].id + '" class="' + weeglydata.weekitems[i][t].classes + '">' + weeglydata.weekitems[i][t].val + '</li>');
          }
          $('.sortable' + i + ' li').bind('click', function() {

             if ($(this).hasClass('noclick')) {
              $(this).removeClass('noclick');
              return false;
             }

             $('.connectedlist li').not(this).removeClass('highlighted');
             $(this).addClass('highlighted'); 
             $('#popupcontent').popup({
              escape: false,
              blur: false,
              onopen: function() {
                reflectentry();
              },
              onclose: function() { 
                $('.connectedlist li').removeClass('highlighted');
              }}).popup('show');
           });
        } else {

        }
      }

    }

    function recapentries(init) {

      if(init) {

        Queue.push(function(){
          $.ajax({
            url: '/index.php/rpc/updentries/init',
            type: 'POST',
            data: {entries: ''},
          })
          .done(function(data, textStatus, jqXHR) {
            if(data=='-1') { location.href = '/index.php/account/logout'; } else {
              reflectentries(data);
              unsetLoading();
            }
          })
          .fail(function() {
            console.log("error");
          });
          
        });

      } else {

        // send Entries up
        var arr = new Array();
        var temp = new Array();
        for(var i=0; i<=7; i++) {
          temp = Array();
          $('.sortable' + i).children('li').each(function(obj){temp.push({ id: this.id, val: $(this).html(), classes: $(this).attr('class') })});
          arr.push(temp);
        }
        Entries = arr;

        entriesjson = JSON.stringify(Entries);
        console.log(entriesjson);

        Queue.push(function(){

          $.ajax({
            url: '/index.php/rpc/updentries',
            type: 'POST',
            data: {entries: entriesjson},
          })
          .done(function(data, textStatus, jqXHR) {
            if(data=='-1') { location.href = '/index.php/account/logout'; } else {
              reflectentries(data);
              unsetLoading();
            }
          })
          .fail(function() {
            console.log("error");
          });
          
        });

      }

      return true;
    }

    function newitem(listid, itemid, pos, text, statusdone, statusimportance, statusdelayed) {
      var classes = new Array();
      if(statusdone) classes.push('.statusdone');
      if(statusimportance) classes.push('.importance-' + statusimportance);
      if(statusdelayed) classes.push('.delayed-' + statusdelayed);

      if(pos=='first') {
        $('.' + listid).prepend("<li id=\"" + itemid + "\" class=\"" + classes.join(" ", classes) + "\">" + text + "</li>");
      } else if(pos=='last') {
        $('.' + listid).append("<li id=\"" + itemid + "\" class=\"" + classes.join(" ", classes) + "\">" + text + "</li>");
      } else {
        return false;
      }
      return true;
    }

    $(document).ready(function() {

      // sortable events
      $('.sortable1, .sortable2, .sortable3, .sortable4, .sortable5, .sortable6, .sortable7, .sortable0').sortable({
        connectWith: '.connectedlist',
        placeholder: 'ui-state-highlight',
        receive: function(event,ui) {
          recapentries(false);
          console.log('receive');
        },
        update: function(event, ui) {
          recapentries(false);
          console.log('update');          
        },
        start: function(event, ui) {
          ui.item.addClass('noclick');
        }
      });

      // navigate to this week
      $('.navbar-brand').click(function(){
        Queue.push(function(){
          $.ajax({
            url: '/index.php/rpc/navweek/',
            type: 'POST',
            data: {entries: ''},
          })
          .done(function(data, textStatus, jqXHR) {
            if(data=='-1') { location.href = '/index.php/account/logout'; } else {
              reflectentries(data);
              unsetLoading();
            }
          })
          .fail(function() {
            console.log("error");
          });
        });
      });

      // newitem events
      $('.newitem').keypress(function(event) {
        if(event.which==13 && this.value.length>0) {
          var newid = newrandomid('I');
          newitem($(this).attr('data-forlist'), newid, 'first', this.value, 0, 'normal', '0');
          this.value = '';
          recapentries();
          event.preventDefault();
        }
      });

      // popup
      $('#popupcontent').popup({
        background: true
      });

      // statusdone
      $('.mark-as-done').click(function() {
        $(this).toggleClass('btn-success');
        $(this).toggleClass('btn-default');
      });

      // datepicker
      var $input = $('#inp-itemdate').pickadate({
        format: 'd mmm, yyyy',
        formatSubmit: 'd mmm, yyyy',
      });
      datepickerobj = $input.pickadate('picker');

      // popup conclusions
      $('.btndeleteentry').click(function(){
        if(confirm("Are you sure to delete this item ?\n\n" + $('.highlighted').text() + "\n\nThis action can't be undone!")) {
          deleteentry();          
        }
      });

      $('.btncancel').click(function(){
        $('#popupcontent').popup('hide');
        $('.highlighted').removeClass('highlighted');
      });

      $('.btnsaveentry').click(function(){
        updateentry();
      });

      recapentries(true);

      setInterval(function(){
        if(!isProcessingQueue && Queue.length) {
          Queue[0]();
          setLoading();
          Queue.shift();
        }
        return true;
      }, 500);

    });
    </script>
  </body>
</html>
