
function printReceipt(itemTitle, ownerName, ownerEmail, duration, rent, deposit, total, txnId) {
    const printWindow = window.open('', '_blank', 'width=650,height=600');
    
    const invoiceHtml = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Payment Receipt - CampusShare</title>
            <style>
                body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 30px; color: #1e293b; }
                .invoice-box { border: 1px solid #e2e8f0; border-radius: 8px; padding: 24px; max-width: 550px; margin: 0 auto; }
                .header { text-align: center; border-bottom: 2px solid #003366; padding-bottom: 12px; margin-bottom: 18px; }
                .header h2 { color: #003366; margin: 0 0 4px 0; }
                .header p { color: #64748b; font-size: 13px; margin: 0; }
                .badge-paid { background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 12px; display: inline-block; margin-top: 8px; }
                .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 18px; font-size: 13px; }
                .meta-table td { padding: 6px 0; }
                .item-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 13px; }
                .item-table th { background: #f8fafc; border-bottom: 2px solid #cbd5e1; text-align: left; padding: 8px; }
                .item-table td { border-bottom: 1px solid #f1f5f9; padding: 8px; }
                .total-row { font-weight: bold; font-size: 15px; color: #003366; }
                .footer-text { text-align: center; font-size: 11px; color: #94a3b8; margin-top: 25px; border-top: 1px dashed #cbd5e1; padding-top: 12px; }
            </style>
        </head>
        <body>
            <div class="invoice-box">
                <div class="header">
                    <h2>CampusShare Payment Receipt</h2>
                    <p>Verified Intra-Campus Academic Rental Transaction</p>
                    <span class="badge-paid">TRANSACTION VERIFIED</span>
                </div>
                
                <table class="meta-table">
                    <tr>
                        <td><strong>Transaction ID:</strong> ${txnId}</td>
                        <td style="text-align: right;"><strong>Date:</strong> ${new Date().toLocaleDateString()}</td>
                    </tr>
                    <tr>
                        <td><strong>Lender / Owner:</strong> ${ownerName}</td>
                        <td style="text-align: right;"><strong>Lender Email:</strong> ${ownerEmail}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Rental Duration:</strong> ${duration}</td>
                    </tr>
                </table>

                <table class="item-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th style="text-align: right;">Amount (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rental Fee (${itemTitle})</td>
                            <td style="text-align: right;">৳${rent}</td>
                        </tr>
                        <tr>
                            <td>Refundable Security Deposit</td>
                            <td style="text-align: right;">৳${deposit}</td>
                        </tr>
                        <tr class="total-row">
                            <td style="padding-top: 12px;">Total Paid Amount:</td>
                            <td style="text-align: right; padding-top: 12px;">৳${total}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="footer-text">
                    This is an electronically generated receipt for simulated platform transactions.<br>
                    Keep this receipt during physical item collection and return.
                </div>
            </div>
            <script>
                window.onload = function() {
                    window.print();
                };
            <\/script>
        </body>
        </html>
    `;

    printWindow.document.write(invoiceHtml);
    printWindow.document.close();
}