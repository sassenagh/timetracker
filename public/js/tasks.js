(function () {
  'use strict';
  var secondsLabel = document.getElementById ('seconds'),
    minutesLabel = document.getElementById ('minutes'),
    hoursLabel = document.getElementById ('hours'),
    totalSeconds = 0,
    startButton = document.getElementById ('start'),
    stopButton = document.getElementById ('stop'),
    taskname = document.getElementById ('task-name'),
    timer = null;

  startButton.onclick = function () {
    if (!timer && taskname.value.length > 0) {
      timer = setInterval (setTime, 1000);
      iniData (taskname.value);
      taskname.disabled = true;
      startButton.disabled = true;
    }
  };

  stopButton.onclick = function () {
    if (timer && taskname.value.length > 0) {
      clearInterval (timer);
      timer = null;
      resetTime ();
      updateData (taskname.value);
      taskname.disabled = false;
      startButton.disabled = false;
      taskname.value = '';
    }
  };

  function setTime () {
    totalSeconds++;
    secondsLabel.innerHTML = pad (totalSeconds % 60);
    minutesLabel.innerHTML = pad (parseInt (totalSeconds / 60));
    hoursLabel.innerHTML = pad (parseInt (totalSeconds / 3600));
  }

  function resetTime () {
    totalSeconds = 0;
    secondsLabel.innerHTML = pad (0);
    minutesLabel.innerHTML = pad (0);
    hoursLabel.innerHTML = pad (0);
  }

  function pad (val) {
    var valString = val + '';
    if (valString.length < 2) {
      return '0' + valString;
    } else {
      return valString;
    }
  }
}) ();

function iniData (newName) {
  request = new XMLHttpRequest ();
  request.open ('POST', 'createTask');
  request.setRequestHeader ('Content-Type', 'application/json');
  request.setRequestHeader (
    'X-CSRF-TOKEN',
    document.querySelector ('meta[name="csrf-token"]').getAttribute ('content')
  );
  request.onload = function () {
    if (request.status === 200 && request.responseText !== newName) {
      console.log (
        'Something went wrong.  Name is now ' + request.responseText
      );
    } else if (request.status !== 200) {
      console.log ('Request failed.  Returned status of ' + request.status);
    }
  };
  data = {task_name: newName};
  request.send (JSON.stringify (data));
}

function updateData (newName) {
  request = new XMLHttpRequest ();
  request.open ('POST', 'updateTask');
  request.setRequestHeader ('Content-Type', 'application/json');
  request.setRequestHeader (
    'X-CSRF-TOKEN',
    document.querySelector ('meta[name="csrf-token"]').getAttribute ('content')
  );
  request.onload = function () {
    if (request.status === 200 && request.responseText !== newName) {
      console.log (
        'Something went wrong.  Name is now ' + request.responseText
      );
    } else if (request.status !== 200) {
      console.log ('Request failed.  Returned status of ' + request.status);
    }
  };
  data = {task_name: newName};
  request.send (JSON.stringify (data));

  setTimeout (refreshPage (), 1500);
}

function refreshPage () {
  window.location.reload ();
}
