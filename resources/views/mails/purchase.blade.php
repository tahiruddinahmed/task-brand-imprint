<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Purchase Confirmation</title>

    <style>
        /* Small inline fallbacks for email clients */
        a {
            color: inherit;
            text-decoration: none;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        img {
            border: 0;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        /* Page background */
        body {
            background-color: #f3f4f6;
            /* light gray */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
            color: #374151;
            /* neutral dark */
            padding: 24px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Container card */
        table.max-w-xl {
            width: 100%;
            max-width: 720px !important;
            border-radius: 10px;
            overflow: hidden;
        }

        /* Header */
        td[style*="bg-gradient-to-r"],
        .email-header {
            background: linear-gradient(90deg, #3741d6 0%, #5b4de6 100%) !important;
            color: #ffffff !important;
            padding: 20px 22px !important;
        }

        /* Brand text and order number row */
        .email-header .brand {
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 0.2px;
        }

        .email-header .order-number {
            font-size: 12px;
            opacity: 0.9;
            color: rgba(255, 255, 255, 0.95);
        }

        /* Greeting */
        h1 {
            margin: 0 0 6px 0;
            font-size: 20px;
            color: #111827;
        }

        td.px-6.py-6 p {
            margin: 0;
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
        }

        /* Order summary table styles */
        table.w-full thead th {
            font-weight: 600;
            font-size: 13px;
            color: #6b7280;
            padding: 12px 14px !important;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        table.w-full tbody tr {
            background: #ffffff;
        }

        table.w-full tbody td {
            padding: 14px !important;
            vertical-align: middle;
            border-top: 1px solid rgba(15, 23, 42, 0.04);
        }

        /* Product thumbnail placeholder */
        .product-thumb {
            width: 56px;
            height: 56px;
            border-radius: 8px;
            background: #f3f4f6;
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            line-height: 56px;
            color: #9ca3af;
            font-size: 12px;
            margin-right: 12px;
        }

        /* Product title & remark */
        .product-title {
            font-weight: 600;
            color: #111827;
            font-size: 15px;
        }

        .product-remark {
            font-weight: 600;
            color: #1f2937;
        }

        /* Qty cell */
        td[align="center"] {
            font-weight: 500;
            color: #374151;
        }

        /* Footer block */
        .footer-cell {
            background: #f9fafb;
            color: #6b7280;
            font-size: 13px;
            padding: 18px;
        }

        /* CTA button style (for clients that support it) */
        a.button {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
            display: inline-block !important;
            padding: 12px 18px !important;
            border-radius: 8px !important;
            text-decoration: none !important;
            font-weight: 600 !important;
        }

        /* Small screen adjustments (preview only; many email clients ignore) */
        @media only screen and (max-width: 480px) {
            .email-header div {
                display: block !important;
            }

            .email-header .order-number {
                margin-top: 8px;
                text-align: left;
            }

            table.max-w-xl {
                border-radius: 6px;
            }

            td.px-6.py-6 {
                padding: 16px !important;
            }

            table.w-full thead {
                display: none;
            }

            /* collapse headings on tiny screens */
            table.w-full tbody td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            table.w-full tbody tr {
                margin-bottom: 12px;
                display: block;
            }
        }

        /* Accessibility: make links obviously interactive */
        a {
            color: #2563eb;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Fallbacks for email clients that strip classes:
   add inline-safe selectors for major elements */
        tr>td[align="center"] {
            text-align: center;
        }
    </style>
</head>

<body class="bg-gray-100 p-6">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="max-w-xl w-full bg-white rounded-lg shadow-md overflow-hidden" cellpadding="0"
                    cellspacing="0" role="presentation">
                    <!-- Header -->
                    <tr>
                        <td class="px-6 py-6 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="font-weight:700; font-size:20px;">Brand Imprint</div>
                                <div style="margin-left:auto; font-size:13px; opacity:0.9;">Order #:
                                    {{ $purchase->id . '-' . strtolower(str_replace(' ', '', $purchase->product->name)) ?? '—' }}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td class="px-6 py-6">
                            <h1 class="text-xl font-semibold text-gray-800">Thank you for your purchase,
                                {{ $purchase->customer->name }} 👋</h1>
                            <p class="mt-2 text-gray-600">
                                We’ve received your order and are getting it ready. Here’s a summary of your purchase.
                            </p>
                        </td>
                    </tr>

                    <!-- Order summary -->
                    <tr>
                        <td class="px-6 pb-6">
                            <div class="border rounded-lg overflow-hidden">
                                <table class="w-full" cellpadding="12" cellspacing="0" role="presentation">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th align="left" class="text-sm text-gray-600 px-4 py-3">Item</th>
                                            <th align="center" class="text-sm text-gray-600 px-4 py-3">Qty</th>
                                            <th align="right" class="text-sm text-gray-600 px-4 py-3">Remark</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr class="border-t">
                                            <td class="px-4 py-4">
                                                <div class="flex items-center gap-3">
                                                    {{-- @if (optional($purchase->product)->image)
                            <img src="{{ $purchase->product->image }}" alt="product" width="56" height="56" class="rounded-md object-cover" />
                          @else
                            <div class="w-14 h-14 rounded-md bg-gray-100 flex items-center justify-center text-sm text-gray-500">IMG</div>
                          @endif --}}

                                                    <div>
                                                        <div class="font-medium text-gray-800">
                                                            {{ $purchase->product->name ?? 'Product name' }}</div>
                                                        {{-- <div class="text-sm text-gray-500">{{ $purchase->product->short_description ?? '' }}</div> --}}
                                                    </div>
                                                </div>
                                            </td>

                                            <td align="center" class="px-4 py-4 text-gray-700">
                                                {{ $purchase->quantity ?? 1 }}</td>
                                            <td align="right" class="px-4 py-4 font-medium text-gray-800">
                                                {{-- ₹{{ number_format(optional($purchase->product)->price ?? 0, 2) }} --}}
                                                {{ $purchase->product->remark }}
                                            </td>
                                        </tr>
                                    </tbody>

                                    {{-- <tfoot class="bg-gray-50">
                    <tr>
                      <td colspan="2" class="px-4 py-4 text-sm text-gray-700">Subtotal</td>
                      <td align="right" class="px-4 py-4 text-sm text-gray-800">₹{{ number_format((optional($purchase->product)->price ?? 0) * ($purchase->quantity ?? 1), 2) }}</td>
                    </tr>
                    <tr>
                      <td colspan="2" class="px-4 py-4 text-sm text-gray-700">Shipping</td>
                      <td align="right" class="px-4 py-4 text-sm text-gray-800">₹{{ number_format($purchase->shipping_cost ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                      <td colspan="2" class="px-4 py-4 font-semibold text-gray-800">Total</td>
                      <td align="right" class="px-4 py-4 font-semibold text-indigo-600">₹{{ number_format(($purchase->total ?? (optional($purchase->product)->price ?? 0) * ($purchase->quantity ?? 1) + ($purchase->shipping_cost ?? 0)), 2) }}</td>
                    </tr>
                  </tfoot> --}}
                                </table>
                            </div>
                        </td>
                    </tr>

                    <!-- CTA -->
                    {{-- <tr>
            <td class="px-6 pb-6">
              <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <a href="{{ $purchaseUrl ?? url('/') }}" class="button bg-indigo-600 text-white font-medium text-center"
                   style="background-color:#4f46e5; color:#fff; padding:12px 18px; border-radius:8px; display:inline-block;">
                  View your order
                </a>

                <a href="{{ $invoiceUrl ?? '#' }}" class="text-sm text-gray-600 underline ml-0 sm:ml-4">
                  Download Invoice
                </a>
              </div>
            </td>
          </tr> --}}

                    <!-- Footer -->
                    <tr>
                        <td class="px-6 py-6 bg-gray-50 text-sm text-gray-600">
                            <div>
                                <p class="mb-1">Order placed on:
                                    {{ optional($purchase->created_at)->format('F j, Y, g:i A') ?? now()->format('F j, Y') }}
                                </p>
                                <p>If you have any questions, reply to this email or contact our support at <a
                                        href="mailto:support@yourcompany.com"
                                        class="text-indigo-600">support@brandimprint.com</a>.</p>
                            </div>

                            <div class="mt-4 text-xs text-gray-400">
                                © {{ date('Y') }} BrandImprint. All rights reserved.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
