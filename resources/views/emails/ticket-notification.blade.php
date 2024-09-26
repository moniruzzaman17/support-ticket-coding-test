<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Ticket Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .ticket-info {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #e2e2e2;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .ticket-info p {
            margin: 5px 0;
            color: #555;
            font-size: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Ticket Created (#{{ $ticket->ticket_number }})</h1>
        <div class="ticket-info">
            <p><strong>Ticket Number:</strong> #{{ $ticket->ticket_number }}</p>
            <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
            <p><strong>Category:</strong> {{ $ticket->category->name }}</p>
            <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
            <p><strong>Message:</strong></p>
            <p>{!! $ticket->message !!}</p>
        </div>
        <div class="footer">
            <p>Thank you for your attention!</p>
            <p>The Netcoden Support Team</p>
        </div>
    </div>
</body>
</html>
