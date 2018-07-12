 Array.prototype.count = function(obj){
	var count = this.length;
	if(typeof(obj) !== "undefined"){
		var array = this.slice(0), count = 0; // clone array and reset count
		for(i = 0; i < array.length; i++){
			if(array[i] == obj){
				count++;
			}
		}
	}
	return count;
}

$dc = function(id) {
	return document.getElementById(id);
};

function firstLoad(){
	addAclass("r1","active");
	addAclass("q1","active");
}

firstLoad();


var tabQuest = Array('q1a','q1b','q1c','q2a','q2b','q2c','q3a','q3b','q3c');
var dcreponse = Array();



for(var t in tabQuest){
	if(t != 'count'){
		var iid = tabQuest[t];
		//console.log(t);
		$dc(iid).addEventListener('click',function(e){
			e.preventDefault();
			var ref = this.getAttribute("href")
			if(dcreponse.length<3) dcreponse.push(ref);
			
			console.log("response:" +ref);
			
			
			switch(dcreponse.length){
				case 1:
					removeAclass("q1","active");
					addAclass("q2","active");
					removeAclass("r1","active");
					addAclass("r2","active");
				break;
				case 2:
					removeAclass("q2","active");
					addAclass("q3","active");
					removeAclass("r2","active");
					addAclass("r3","active");
				break;
				case 3:
					removeAclass("q3","active");
					removeAclass("r3","active");
					addAclass("results","active");
					
					if(dcreponse.count('a')>=2){
						addAclass("resa","active");
					}
					if(dcreponse.count('b')>=2){
						addAclass("resb","active");
					}
					if(dcreponse.count('c')>=2){
						addAclass("resc","active");
					}
					if(dcreponse.count('a')==1 && dcreponse.count('b')==1 && dcreponse.count('c')==1){
						addAclass("resd","active");
					}
				break;
				default:
				break;
			}
			return false;
			e.returnValue = false;
		},false);
	}
}


function addAclass(id, classe){
	$dc(id).classList ? $dc(id).classList.add(classe) : $dc(id).className += ' '+classe;
}

function removeAclass(id,classe){
	$dc(id).className = $dc(id).className.replace(' ' + classe, '').replace(classe, '');
}

function count(arr) {
    var a = [], b = [], prev;

    arr.sort();
    for ( var i = 0; i < arr.length; i++ ) {
        if ( arr[i] !== prev ) {
            a.push(arr[i]);
            b.push(1);
        } else {
            b[b.length-1]++;
        }
        prev = arr[i];
    }

    return [a, b];
}