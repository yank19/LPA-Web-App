// scrip for the login

document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    // Get the values from the form inputs
    const username = document.querySelector('input[placeholder="Username"]').value;
    const password = document.querySelector('input[placeholder="Password"]').value;

    // Simple validation 
    if (username && password) {
        console.log('Username:', username);
        console.log('Password:', password);
        alert('Login successful!');
    } else {
        alert('Please fill in all fields.');
    }
});


// scrip for the sing up

document.getElementById('register').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    // Get the values from the form inputs
    const username = document.querySelector('input[placeholder="Username"]').value;
    const email = document.querySelector('input[placeholder="Email"]').value;
    const password = document.querySelector('input[placeholder="Password"]').value;

    // Simple validation 
    if (username && email && password) {
        console.log('Username:', username);
        console.log('Email:', email);
        console.log('Password:', password);
        alert('Registration successful!');
    } else {
        alert('Please fill in all fields.');
    }
});
