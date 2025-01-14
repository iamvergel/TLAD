const http = require('http');

// URL of the PHP script
const phpScriptUrl = 'http://localhost/Dental-Clinic-Management-System/admin/pages/online-appointments/update-status.php';

// Function to execute the PHP script via HTTP request
function executeUpdateScript() {
    // Indicate that the script is running
    console.log("PHP script execution started at: " + new Date().toLocaleTimeString());

    // Parse the URL
    const url = new URL(phpScriptUrl);

    // Set up the options for the HTTP request
    const options = {
        hostname: url.hostname,
        port: 80,  // Default HTTP port
        path: url.pathname + url.search,
        method: 'GET', // HTTP method
    };

    // Send the GET request to the PHP script
    const req = http.request(options, (res) => {
        let data = '';

        // Collect the response data
        res.on('data', (chunk) => {
            data += chunk;
        });

        // Handle the response once it's fully received
        res.on('end', () => {
            console.log('PHP Script executed successfully!');
            console.log('Response:', data); // Log the response from the PHP script
            console.log('Execution completed at: ' + new Date().toLocaleTimeString());
        });
    });

    // Handle any errors with the request
    req.on('error', (error) => {
        console.error('Error executing PHP script:', error);
    });

    // End the request
    req.end();
}

// Execute the PHP script immediately once
executeUpdateScript();

// Execute the PHP script every 5 minutes (300000 milliseconds)
setInterval(executeUpdateScript, 300000); // 5 minutes = 5 * 60 * 1000 ms
