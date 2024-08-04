<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Certificate_pdf</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
  <form id="form" class="w-50 m-3 shadow p-3 mb-5 bg-body-tertiary rounded" style="min-width: 200px" action="server.php" method="POST">
    Номер:
    <br />
    <input class="form-control" id="courseID" type="text" name="courseID" maxlength="100" placeholder="номер курсу" required />

    <br />
    Курс:
    <br />
    <input class="form-control" type="text" name="courseName" maxlength="100" placeholder="назва курсу" required />
    <br />
    Ім'я учня:
    <br />
    <input class="form-control" type="text" name="studentName" maxlength="100" placeholder="ім'я учня" required />
    <br />
    Дата завершення курсу:
    <br />
    <input class="form-control" type="date" name="graduationDate" placeholder="дата завершення" required />
    <button class="btn btn-primary m-2" id="downloadReportPDF" type="submit">
      Отримати сертифікат
    </button>
  </form>
</body>

</html>

<!-- завдання https://docs.google.com/document/d/1__9M0ztm1VifyZwLB9Sl6S3xo8NlJSoCBYIKxvpIUxQ/edit -->