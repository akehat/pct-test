function single_action(id) {
    console.log(`${id} was single clicked`);
    let el = document.getElementById(id);
    id++;
    el.textContent = id;
    if (id % 2 == 0) {
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
    if (id % 2 == 0) {
        el.classList.remove('odd');
    } else {
        el.classList.remove('even');
    }
    $.ajax({
        url: `/getName/${id}`, success: function (result) {
            console.log('result', result);
            $(`#${id}`).html(result);
        }
    });
    el.classList.add('double-click');
}