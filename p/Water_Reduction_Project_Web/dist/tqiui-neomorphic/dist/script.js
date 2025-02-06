let store = {};

const createElement = (tagName, props = {}) => {
  let element = document.createElement(tagName);
  Object.keys(props).forEach(function (prop) {
    if (['role', 'selected'].includes(prop) || prop.indexOf('data-') == 0) {
      if (prop != 'selected' || (prop == 'selected' && props[prop] != ''))
        element.setAttribute(prop, props[prop]);
    } else {
      element[prop] = props[prop];
    }
  });
  return element;
}

const initialize = () => {
  drawVehicle();
}

const drawVehicle = () => {
  let page = document.querySelector('.container');
  let container = document.querySelector('.vehicle');
  container.appendChild(drawSelect());
  page.appendChild(container);
}

const drawSelect = () => {
  let field = document.querySelector('.field.option');
  let input = field.querySelector('input');
  let options = field.querySelector('.optionList');

  field.addEventListener('click', toggleSelect.bind(this, field));
  input.addEventListener('keyup', filterOptions.bind(this, input, field));
  
  Array.from(options.children).forEach(option => {
    option.addEventListener('click', setSelectValue.bind(this, option, input));
  });

  return field;
}

const toggleSelect = (field) => {
  field.classList.toggle('active');
}

const setSelectValue = (option, input) => {
  input.value = option.textContent;
}

const filterOptions = (input, field) => {
  Array.from(field.querySelectorAll('.optionItem')).forEach(item => 
    (!item.textContent.includes(input.value)) ? item.classList.add('displayNone') : item.classList.remove('displayNone')
  );
}

initialize();
