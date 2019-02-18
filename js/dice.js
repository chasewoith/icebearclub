document.querySelector('input[type=button]').addEventListener('click', function(){rollTheDice();});

var rollTheDice = function() {
    var i,
        faceValue,
        output = '',
        diceCount = ice_vars.difficulty || 2;
    for (i = 0; i < diceCount; i++) {
        faceValue = Math.floor(Math.random() * 6);
        output += "&#x268" + faceValue + "; ";
    	document.getElementById('dice').setAttribute("class",+faceValue);
    }
    document.getElementById('dice').innerHTML = output;
}