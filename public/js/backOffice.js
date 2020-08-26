let btns_supprimer = document.querySelectorAll('.btn_supprimer');

/*for(i = 0; i < btns_supprimer.length; i++) {
    btns_supprimer[i].addEventListener('click', () => {
        confirm('Etes-vous sur de vouloir supprimer définitivement cet article ?');
    })
}*/

let add_categorie = document.querySelector('#add_categorie');

add_categorie.addEventListener('click', (e) => {
    e.preventDefault();
});

let new_categorie = document.querySelectorAll('.new_categorie');

let add_ingredient = document.querySelector('#add_ingredient');
let i = document.querySelectorAll('.single_ingredient').length;
let j = document.querySelectorAll('.single_category').length;
console.log('i : ' + i + " j : " + j);
add_ingredient.addEventListener('click', (e) => {
    e.preventDefault();

    i += 1;
    let div = document.createElement('div');
    let label = document.createElement('label');
    let input = document.createElement('input');

    div.setAttribute('class', 'form-group single_ingredient');
    label.setAttribute('for', 'ingredient-' + i);
    label.innerHTML = "Ingredient n°" + i;
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'ingredient[]');
    input.setAttribute('id', 'ingredient-' + i);
    input.setAttribute('class', 'form-control');

    div.append(label);
    div.append(input);
    document.querySelector('#ingredients').append(div);


});

let add_etape = document.querySelector('#add_etape');
let k = document.querySelectorAll('.single_etape').length;
add_etape.addEventListener('click', (e) => {
    e.preventDefault();

    k += 1;
    let div = document.createElement('div');
    let label = document.createElement('label');
    let input = document.createElement('textarea');

    div.setAttribute('class', 'form-group single_etape');
    label.setAttribute('for', 'etape-' + k);
    label.innerHTML = "Etape n°" + k;
    input.setAttribute('rows', '5');
    input.setAttribute('cols', '33');
    input.setAttribute('name', 'etape[]');
    input.setAttribute('id', 'etape-' + k);
    input.setAttribute('class', 'form-control');

    div.append(label);
    div.append(input);
    document.querySelector('#etapes').append(div);


});

function a(cat) {
    j += 1;

    let form_group = document.createElement('div');
    let single_category = document.createElement('div');
    let divButton = document.createElement('div');

    let button = document.createElement('button');

    let label = document.createElement('label');
    let select = document.createElement('select');

    single_category.setAttribute('class', 'row single_category div_' + j);
    button.setAttribute('class', 'btn btn-warning new_categorie');
    button.setAttribute('id', 'n' + j);
    button.setAttribute('onclick', 'changeInput(' + j + ')');
    button.innerHTML = "Nouvelle catégorie";


    form_group.setAttribute('class', 'form-group');
    label.setAttribute('for', 'categorie-' + j);
    label.innerHTML = "Categorie n°" + j;
    select.setAttribute('name', 'categorie[]');
    select.setAttribute('id', 'categorie-' + j);
    select.setAttribute('class', 'form-control col-md-8');

    for(let i = 0; i < cat.length; i++) {
        let option = document.createElement('option');
        option.setAttribute('value', cat[i]['nom']);
        option.innerHTML = cat[i]['nom'];
        select.append(option);
    }

    divButton.append(button);
    single_category.append(select);
    single_category.append(divButton);

    form_group.append(label);
    form_group.append(single_category);
    document.querySelector('#categories').append(form_group);
}

function changeInput(id, e = event) {

    e.preventDefault();
    let select = document.querySelector('#categorie-' + id);
    let single_category = document.querySelector('.div_' + id);

    let input = document.createElement('input');

    input.setAttribute('type', 'text');
    input.setAttribute('name', 'categorie[]');
    input.setAttribute('id', 'categorie');
    input.setAttribute('class', 'form-control col-md-8');

    select.remove();

    single_category.prepend(input);
}


