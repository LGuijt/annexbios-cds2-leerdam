async function loadContent(){
    const response = await fetch('https://u231195.gluwebsite.nl/api/v1/movieData', {
        headers: {
          'Authorization': 'Bearer 2b8e7f9a3c1d5e4f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6a7b8c9d',
        }
      });

    const data = await response.json();
    dataArray = data.data;
    console.log(dataArray);
    for (let i = 0; i < dataArray.length; i++){
      console.log(dataArray[i].title);
      const option = document.createElement('option');
      option.value = dataArray[i].api_id;
      option.innerHTML = dataArray[i].title;
      document.getElementById('filmchoice').appendChild(option);
    }
}

loadContent();