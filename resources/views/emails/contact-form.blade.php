<!DOCTYPE html>
<html>

<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <style>
      body {
         font-family: Arial, Helvetica, sans-serif;
      }

      * {
         box-sizing: border-box;
      }

      input[type=text],
      select,
      textarea {
         width: 100%;
         padding: 12px;
         border: 1px solid #ccc;
         border-radius: 4px;
         box-sizing: border-box;
         margin-top: 6px;
         margin-bottom: 16px;
         resize: vertical;
      }

      input[type=submit] {
         background-color: #04AA6D;
         color: white;
         padding: 12px 20px;
         border: none;
         border-radius: 4px;
         cursor: pointer;
      }

      input[type=submit]:hover {
         background-color: #45a049;
      }

      .container {
         border-radius: 5px;
         background-color: #f2f2f2;
         padding: 20px;
      }
   </style>
</head>

<body>

   <h3>Contact Form</h3>

   <div class="container">
      <form>
         <label for="fname">Name</label>
         <input type="text" id="fname" value="{{ $formData['name'] }}" readonly>

         <label for="email">Email</label>
         <input type="text" id="email" value="{{ $formData['email'] }}" readonly>

         <label for="phone">Phone</label>
         <input type="text" id="phone" value="{{ $formData['phone'] }}" readonly>

         <label for="message">Message</label>
         <textarea id="message" style="height:200px" readonly>{{ $formData['message'] }}</textarea>
      </form>
   </div>

</body>

</html>
