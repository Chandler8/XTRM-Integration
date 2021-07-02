/*
var counter_list = [10,10000,10000];
var str_counter_0 = counter_list[0];
var str_counter_1 = counter_list[1];
var str_counter_2 = counter_list[2];
var display_str = "";
*/

var amount = document.getElementById("amount");
var display_div = document.getElementById("balance");
var display_num = parseFloat(display_div.innerHTML);

//display_div.innerHTML = counter_list[1];

/*
function incrementCount(current_count){
    // clear count
    while (display_div.hasChildNodes()) {
        display_div.removeChild(display_div.lastChild);
    }
    str_counter_0++;
    if (str_counter_0 > 99) {
    str_counter_0 = 10; // reset count
    str_counter_1++;    // increase next count
    }
    if(str_counter_1>99999){
    str_counter_2++;
    }
    display_str = str_counter_2.toString() + str_counter_1.toString() + str_counter_0.toString();
    
    for (var i = 0; i < display_str.length; i++) {
    var new_span = document.createElement('span');
    new_span.className = 'num_tiles';
    new_span.innerText = display_str[i];
    display_div.appendChild(new_span);
    }

}
*/
console.log(display_num);

function addToBalance(){
    let display_num = parseFloat(display_div.innerHTML);
    let amount1 = parseFloat(amount.value);
    let total = +(display_num) + amount1;
    console.log("Entered num:" + amount1 + " Total:" + total);
    display_div.innerHTML = total.toFixed(2);
}

function subtractFromBalance(){
    let display_num = parseFloat(display_div.innerHTML);
    let amount1 = parseFloat(amount.value);
    let total = +(display_num) - amount1;
    console.log(amount1 + " " + total);
    display_div.innerHTML = total.toFixed(2);
}

//changeBalance();