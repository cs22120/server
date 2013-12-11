<?php include 'header.php'; ?>
<div class="page-header">
  <h1>Post Tester</h1>
</div>
<form method="POST" action="upload.php">
    <p class="lead">
        Use this form to test JSON uploading to the server.
    </p>
    <p>Anything you type below will be sent as the <code>data</code> parameter in a POST request to the upload script.</p>
    <p>Note that this live: anything you submit, if valid, <em>will</em> be submitted and stored into the database.</p>
    <div class="form-group">
        <textarea style="font-family:monospace; height:600px;" class="form-control" name="data">
{
    "authorization": {
        "hash": "427339AC646C25EFFA6B624CE776FB4FEE99CEDA",
        "salt": "swordfish"
    },
    "walk": {
        "title": "Whitehall Wander",
        "shortDesc": "A short walk around Westminster",
        "longDesc": "A walk around London, viewing sights such as Downing Street, Trafalgar Square, and Scotland Yard",
        "locations": [
            {
                "latitude": 51.503396,
                "longitude": 0.127640,
                "timestamp": 0,
                "descriptions": [
                    "10 Downing Street"
                ],
                "images": [
                    "no10door",
                    "primeminister"
                ]
            },
            {
                "latitude": 51.506758,
                "longitude": 0.128692,
                "timestamp": 20,
                "descriptions": [
                    "Admiralty Arch"
                ],
                "images": [
                ]
            },
            {
                "latitude": 51.49861,
                "longitude": 0.13305,
                "timestamp": 60,
                "descriptions": [
                    "New Scotland Yard",
                    "Metropolitan Police HQ"
                ],
                "images": [
                    "revolvingsign"
                ]
            }
        ]
    }
} </textarea>
        <button type="submit" class="btn btn-default">Submit</button>
    </div>
</form>
