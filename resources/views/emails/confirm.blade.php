<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Благодарим Ви за поръчката!</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 4rem;
        }

        .success-order {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .card-title {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 1rem;
        }

        .card-text {
            color: #495057;
            font-size: 18px;
            margin-bottom: 1rem;
        }

        .list-unstyled {
            color: #495057;
            font-size: 16px;
            list-style: none;
            padding: 0;
        }

        .list-unstyled li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card success-order">
                <h2 class="card-title text-center">Благодарим Ви за поръчката!</h2>
                <p class="card-text text-center">Вашата поръчка е успешно направена. Ще направим всичко възможно, за да я доставим до вас възможно най-скоро!</p>
                <p class="card-text text-center">Имайте предвид, че срокът за изпълнение на поръчки за екипчета "Joggers" e 10 дни.</p>

                <ul class="list-unstyled text-center">
                    <li><strong>Име:</strong> {{ $order->first_name }}</li>
                    <li><strong>Фамилия:</strong> {{ $order->last_name }}</li>
                    <li><strong>Държава:</strong> {{ $order->country }}</li>
                    <li><strong>Адрес:</strong> {{ $order->address }}</li>
                    <li><strong>Град:</strong> {{ $order->city }}</li>
                    <li><strong>Пощенски код:</strong> {{ $order->post_code }}</li>
                    <li><strong>Телефонен номер:</strong> {{ $order->number }}</li>
                    <li><strong>Имейл:</strong> {{ $order->email }}</li>
                    <li><strong>Допълнителна информация:</strong> {{ $order->note ?? 'Няма' }}</li>
                </ul>

                <p class="card-text text-center">Благодарим ви, че пазарувахте от нас! 🎉</p>
                <p class="card-text text-center">Очаквайте поръчката си с нетърпение! 🚚</p>
            </div>
        </div>
    </div>
</div>
</body>

</html>
