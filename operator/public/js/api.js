      // const API_URL = "https://gofresha.in/services/index.php/";
// Category Form Submit

const form = document.getElementById('categoryForm');
form.addEventListener('submit', async function (e) {
  e.preventDefault();

  const formData = new FormData(form);

  try {
    const response = await fetch(API_URL + 'product_add_category', {
      method: 'POST',
      headers: {
        'X-Api': 'Bearer ' + API_KEY
      },
      body: formData
    });

    const data = await response.json();
    console.log(data);
    if (data.status === 'success') {
      window.location.href = data.redirect;
    }
  } catch (error) {
    console.error('Error:', error);
  }
});



// SubCategory Form Submit
  const subCategory_Form2 = document.getElementById('subCategory_Form2');

  subCategory_Form2.addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData2 = new FormData(subCategory_Form2);

    try {
      const response = await fetch(API_URL + 'addSubCategory', {
        method: 'POST',
        headers: {
          'X-Api': 'Bearer ' + API_KEY
        },
        body: formData2
      });

      const data = await response.json();

        
      if (data.status === 'success') {
        window.location.href = data.redirect;
      }

   
    } catch (error) {
      console.error('Error:', error);
    }
  });




const addProductForm = document.getElementById('addProductForm');

addProductForm.addEventListener('submit', async function(e) {
    e.preventDefault();

    const addProductFormData = new FormData(addProductForm);

    try {
        const response = await fetch(API_URL + 'addproduct', {
            method: 'POST',
            headers: {
                'X-Api': 'Bearer ' + API_KEY
            },
            body: addProductFormData
        });

        const data = await response.json();


        if (data.status === 'success') {
            console.log(data);
            // window.location.href = data.redirect;
        }
            document.getElementById('response').innerText =
        JSON.stringify(data, null, 2);

    } catch (error) {
        console.error('Error:', error);
    }
});