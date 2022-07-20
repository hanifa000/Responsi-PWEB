function insert(num){
	document.form.text.value = document.form.text.value + num;
}

function menfi() {
    reqem = document.form.text.value;
    reqem = "-" + reqem;
    document.form.text.value = reqem;
}

function equal(){
	var hasil = document.form.text.value;
	document.form.text.value = eval(hasil);
}

function clean(){
	document.form.text.value = "";
}

function back(){
	var hasil = document.form.text.value;
	document.form.text.value = hasil.substring(0,hasil.length-1);
}