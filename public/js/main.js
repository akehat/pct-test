
function single_action(id) {
    console.log(`${id} was single clicked`);
    let el = document.getElementById(id);
    let value = getValue(id);
    value++;
    el.textContent = value;
    if (value % 2 == 0) {
        el.classList.remove('odd');
        el.classList.add('even');
    } else {
        el.classList.remove('even');
        el.classList.add('odd');
    }
}

function double_action(id) {
    console.log(`${id} was double clicked`);
    let el = document.getElementById(id);
    let value = getValue(id);
    if (value % 2 == 0) {
        el.classList.remove('odd');
    } else {
        el.classList.remove('even');
    }
    $.ajax({
        url: `/getName/${value}`, success: function (result) {
            console.log('result', result);
            $(`#${id}`).html(result);
        }
    });
    el.classList.add('double-click');
}

function getValue(id) {
    let value = id.split('_');
    return value[1];
}