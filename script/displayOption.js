function displayOptions(category) {
const div = document.querySelector('.category-specific');
                    
                    div.classList.add('input')
    if(category == 'painting'){
        div.innerHTML =    '<label>Medium used</label>' +
                            '<input type="text" name="medium_used">'+
                            '<label>Framed</label>' +
                            '<select class="input-category" name="framed">'+
                            '<option value="true">Yes</option>'+
                            '<option value="false">No</option>'+
                            '</select>'+
                            '<label>Height(cm)</label>' +
                            '<input type="text" name="height">'+
                            '<label>Length(cm)</label>' +
                            '<input type="text" name="length">';
                            // div.append()
                            // form.insertBefore(div, buttons)
    }else if(category == 'drawing'){
        // newDiv.innerHTML = '';
        div.innerHTML =  '<label>Medium used</label>' +
                         '<input type="text" name="medium_used">'+
                            '<label>Framed</label>' +
                            '<select class="input-category" name="framed"><option value="true">Yes</option><option value="false">No</option></select>'+
                            '<label>Height(cm)</label>' +
                            '<input type="text" name="height">'+
                            '<label>Length(cm)</label>' +
                            '<input type="text" name="length">';
                            // form.insertBefore(div, buttons)

    }else if(category == 'photographic_image'){
        div.innerHTML =     '<label>Type of Image</label>' +
                            '<select class="input-category" name="image_type"><option value="black_white">Black and White</option><option value="color">Color</option></select>'+
                            '<label>Height(cm)</label>' +
                            '<input type="text" name="height">'+
                            '<label>Length(cm)</label>' +
                            '<input type="text" name="length">';
    }else if(category == 'sculpture'){
        div.innerHTML = '<label>Medium used</label>' +
                         '<input type="text" name="medium_used">'+
                         '<label>Height(cm)</label>' +
                        '<input type="text" name="height">'+
                        '<label>Length(cm)</label>' +
                        '<input type="text" name="length">'+
                        '<label>Weight(kg)</label>' +
                        '<input type="text" name="weight">'
                         ;
    }else if(category == 'carving'){
         div.innerHTML = '<label>Medium used</label>' +
                         '<input type="text" name="medium_used">'+
                         '<label>Height(cm)</label>' +
                        '<input type="text" name="height">'+
                        '<label>Length(cm)</label>' +
                        '<input type="text" name="length">'+
                        '<label>Weight(kg)</label>' +
                        '<input type="text" name="weight">'                        
                        ;
    } 
    
    else{
        console.log('Error')
    }
}


   