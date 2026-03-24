<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Products</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary-color: #007bff;
            /* ABA Blue or your brand color */
            --text-color: #333;
            --bg-color: #f4f6f8;
            --white: #ffffff;
            --danger: #dc3545;
        }

        body {
            font-family:
                -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial,
                sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 20px;
            color: var(--text-color);
        }

        .cart-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .cart-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .cart-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        /* Product List Styling */
        .cart-items {
            padding: 0 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .item-details {
            flex-grow: 1;
            padding-left: 15px;
        }

        .item-name {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .item-price {
            color: #666;
            font-size: 0.95rem;
        }

        .item-remove a {
            color: var(--danger);
            text-decoration: none;
            font-size: 0.9rem;
            border: 1px solid #eee;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .item-remove a:hover {
            background-color: #fff5f5;
            border-color: var(--danger);
        }

        /* Summary Section */
        .cart-summary {
            background-color: #fafafa;
            padding: 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-price {
            font-size: 1.25rem;
            font-weight: bold;
        }

        #checkout_button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }

        #checkout_button:hover {
            background-color: #0069d9;
        }

        /* Empty State Design */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }

        .empty-text {
            font-size: 1.2rem;
            color: #888;
        }

        .btn-continue {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 600;
        }
    </style>
</head>

<body>
    @include('components.navbar')

    <main>
        {{ $slot }}
    </main>
</body>

</html>