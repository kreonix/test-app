const arrow = document.createElement('span');
const getData = (event) => {
  $.ajax({
    type:"GET",
    url:`/getDataForm/${event.currentTarget.dataset.rowId}`,
    success: function(data){

      document.getElementById("nameInput").value = data.name;
      document.getElementById("priceInput").value = data.price;
      document.getElementById("ratingInput").value = data.rating;
      document.getElementById("editForm").dataset.rowId = data.id;
    }
  })
}
const deleteProduct = (event) => {
  event.preventDefault();
  $.ajax({
    type:"GET",
    url:`/deleteProduct/${event.currentTarget.dataset.rowId}`,
    success: function(){
      window.location.replace("/");
    }
  })
}
const sendUpdate = (event) => {
   const inputsData = Array.from(
    document.querySelector('#editForm')
      .elements
    ).map(n => `${n.name}=${n.value}`).join('&')
    $.ajax({
      type:"POST",
      url:`/updateDataForm/${document.getElementById('editForm').dataset.rowId}`,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      timeout: 1000,
      data: inputsData,
      beforeSend: function() {
        event.currentTarget.innerText = 'Изменяем...'
      },
      success: function(){
        document.getElementById('buttonUpload').innerText="Изменить"
        location.reload();
      },
      error: function(){
         document.getElementById('modal-footer-edit').childNodes[0].textContent='Ошибка при изменении';
        document.getElementById('buttonUpload').innerText="Изменить"
      }
    })
}
const createRow = (event) => {
  inputsData = Array.from(
    document.querySelector('#createForm')
      .elements
    ).map(n => `${n.name}=${n.value}`).join('&')
    $.ajax({
      type:"POST",
      url:`/createProduct`,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: inputsData,
      beforeSend: function() {
        event.currentTarget.innerText = 'Добавляем'
      },
      success: function(data){
        document.getElementById('buttonCreate').innerText="Добавить запись"
        location.reload();
      },
      error: function(){
        const modal = document.getElementById('modal-footer-add')
        modal.childNodes[0].textContent = ""
        modal.childNodes[0].textContent = "Ошибка добавления"
        document.getElementById('buttonCreate').innerText="Добавить запись"
      }
    })
}
const renderTable = (data,column, typearrow) => {
  const table = document.getElementById('table');
  table.childNodes[3].innerHTML = data.map((el)=>{
    return `<tr>
    <td>${el.id}</td>
    <td>${el.name}</td>
    <td>${el.price}</td>
    <td>${el.rating}</td>
    <td style="padding:7px">
      <button type="button" class="btn btn-primary" data-row-id="${el.id}" onclick="deleteProduct(event)">DELETE</button>
      <button class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-row-id="${el.id}" onclick="getData(event)">EDIT</button>
    </td>
  </tr>
      `
  }).join('');
  if (typearrow == "desc"){
    arrow.innerHTML="▲"
  }
  else
  {
    arrow.innerHTML="▼"
  }
  
  document.getElementById(column).appendChild(arrow)
}
const sort = (event) => {
  event.preventDefault();
  const table = document.getElementById("table");
  const element = event.currentTarget.text;

  if (table.dataset.typeSort=="" || table.dataset.typeSort=="desc"){
      $.ajax({
        type:"GET",
        url:`/sort/${element}/asc`,
        success: function(data){
          table.dataset.typeSort="asc"
          renderTable(data,element,table.dataset.typeSort);
          window.history.pushState({},null,`${this.url}/view`);
        }
      })
  }
  if (table.dataset.typeSort=="asc"){
    $.ajax({
      type:"GET",
      url:`/sort/${element}/desc`,
      success: function(data){
        table.dataset.typeSort="desc"
        renderTable(data,element,table.dataset.typeSort);
        window.history.pushState({},null,`${this.url}/view`);
      }
    })
}
}