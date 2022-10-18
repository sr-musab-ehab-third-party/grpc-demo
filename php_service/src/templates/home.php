<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="mt-5">Test Logger</h1>
                <hr>

                <div id="output" class="mt-5" style="outline: 1px solid silver; padding: 2em;">
                    <div class="mb-3">
                        <label for="level" class="form-label">Select Level</label>
                        <select class="form-select" aria-label="level" id="level">
                            <option selected disabled value=-1>Select</option>
                            <option value="1">Info</option>
                            <option value="2">Warning</option>
                            <option value="3">Error</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <input type="text" class="form-control" id="message" aria-describedby="message">
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="JSON" id="json" style="height: 100px"></textarea>
                        <label for="json">JSON</label>
                    </div>

                    <div class="mt-3">
                        <button type="submit" id="log" onclick="logData()" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4 class="mt-5">Sent</h4>
                <div class="mt-1" style="outline: 1px solid silver; padding: 2em;">
                    <pre id="payload"><span class="text-muted">Nothing sent yet...</span></pre>
                </div>
            </div>
            <div class="col">
                <h4 class="mt-5">Received</h4>
                <div class="mt-1" style="outline: 1px solid silver; padding: 2em;">
                    <pre id="received"><span class="text-muted">Nothing received yet...</span></pre>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <hr>
            </div>
        </div>
    </div>

    <script>
        let log = document.getElementById("log")
        let output = document.getElementById("output")
        let sent = document.getElementById("payload")
        let received = document.getElementById('received')

        function logData() {
            let level = document.getElementById("level").options[document.getElementById("level").selectedIndex].value
            let message = document.getElementById("message").value
            
            if(level == -1){
                alert("Please Select Level")
                return
            }

            if(message == ""){
                alert("Please Enter Message")
                return
            }
            
            const payload = {
                level: document.getElementById("level").options[document.getElementById("level").selectedIndex].text ,
                message : document.getElementById("message").value,
                data:  document.getElementById("json").value
            }

            const headers = new Headers()
            headers.append("Content-Type", "application/json")

            const body = {
                method: "POSt",
                body: JSON.stringify(payload),
                headers: headers
            }

            fetch("http:\/\/localhost/log-grpc", body)
                .then((response) => response.json())
                .then((data) => {
                    sent.innerHTML = JSON.stringify(payload, undefined, 4)
                    received.innerHTML = JSON.stringify(data, undefined, 4)
                    if (data.error) {
                        output.innerHTML += `<br><strong>Error:</strong> ${data.message}`
                    } else {
                        output.innerHTML += `<br><strong>Response from logger service</strong>: ${data.message}`
                    }
                })
                .catch((error) => {
                    output.innerHTML += `<br><br>Error: ${error}`
                })
        }
    </script>
</body>
</html>
