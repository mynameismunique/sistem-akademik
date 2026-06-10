<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --border-color: #e2e8f0;
            --bg-table: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            background-color: #f8fafc;
            padding: 40px;
            line-height: 1.5;
        }

        .print-container {
            max-width: 1000px;
            margin: 0 auto;
            background: var(--bg-table);
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 20px;
            margin-bottom: 24px;
        }

        .header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }

        .meta-info {
            text-align: right;
            font-size: 13px;
            color: var(--text-light);
        }

        .meta-info span {
            font-weight: 600;
            color: var(--text-dark);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background-color: #f1f5f9;
            color: var(--text-light);
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            border-bottom: 2px solid var(--border-color);
        }

        td {
            padding: 14px 16px;
            font-size: 14px;
            color: var(--text-dark);
            border-bottom: 1px solid var(--border-color);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge-jurusan {
            display: inline-block;
            background-color: #eef2ff;
            color: var(--primary);
            font-size: 12px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .nim-code {
            font-family: monospace;
            background-color: #f1f5f9;
            color: #0f172a;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 13px;
        }

        .fw-semibold {
            font-weight: 600;
        }

        @media print {
            body {
                background-color: #fff;
                padding: 0;
            }
            .print-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
            th {
                background-color: #f1f5f9 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .badge-jurusan {
                background-color: #eef2ff !important;
                color: var(--primary) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .nim-code {
                background-color: #f1f5f9 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="print-container">
        <div class="header">
            <h2>Data Mahasiswa</h2>
            <div class="meta-info">
                <p>Dicetak pada: <span>{{ date('d F Y') }}</span></p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">No</th>
                    <th style="width: 22%;">NIM</th>
                    <th style="width: 40%;">Nama Lengkap</th>
                    <th style="width: 30%;">Program Studi / Jurusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $item)
                <tr>
                    <td class="text-light">{{ $loop->iteration }}</td>
                    <td><span class="nim-code">{{ $item->nim }}</span></td>
                    <td class="fw-semibold">{{ $item->nama }}</td>
                    <td>
                        <span class="badge-jurusan">
                            {{ $item->jurusan->nama_jurusan ?? '-' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>