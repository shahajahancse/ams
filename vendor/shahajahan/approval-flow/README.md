# Approval Flow

[![Packagist Version](https://img.shields.io/packagist/v/shahajahan/approval-flow.svg)](https://packagist.org/packages/shahajahan/approval-flow)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-blue)]()
[![Build Status](https://img.shields.io/github/actions/workflow/status/shahajahan/approval-flow/tests.yml)]()

A **dynamic approval access control system** for any PHP framework (Laravel, CodeIgniter, CakePHP, Symfony, or plain PHP).
Define and manage **multi-level approval roles**, with **forward/backward flow** and **permission checks** — all framework-agnostic.

---

## 🚀 Features

✅ Framework-agnostic core
✅ Works with Laravel, CodeIgniter, Symfony, CakePHP, or raw PHP
✅ Dynamic approval hierarchy (forward/backward flow)
✅ Simple adapter pattern for DB access (PDO, Query Builder, or ORM)
✅ PSR-4 and PSR-12 compliant
✅ Extensible and testable

---

## 🧩 Installation

### Via Composer

```bash
composer require shahajahan/approval-flow
```

If you’re developing locally, clone the repo and link:

```bash
git clone https://github.com/shahajahancse/approval-flow.git
cd approval-flow
composer install
```

---

## 🗃️ Database Schema Example

**approver_user_role**

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| name | varchar(100) | Role name |
| type | enum('user','group','department') | Type of approver |
| sl | int | Serial/order |
| status | tinyint(1) | Active status |
| remarks | varchar(255) | Optional notes |

**approval_role_manage**

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| user_id | int | Assigned user |
| role_id | int | Reference to approver_user_role |
| role_type | enum('approver','reviewer','verifier') | Type of access |
| access_forward | int | ID of next approver role |
| access_backward | int | ID of previous approver role |

---

## ⚙️ Usage Examples

### 🔹 Laravel

```php
use ApprovalFlow\Services\ApprovalFlow;
use ApprovalFlow\Adapters\LaravelAdapter;

$flow = new ApprovalFlow(new LaravelAdapter());

$nextRole = $flow->nextRole(2);
$prevRole = $flow->previousRole(2);
$canApprove = $flow->canApprove(auth()->id(), $documentId);
```

---

### 🔹 CodeIgniter (v3 or v4)

```php
$flow = new \ApprovalFlow\Services\ApprovalFlow(
    new \ApprovalFlow\Adapters\CodeIgniterAdapter($this)
);

$next = $flow->nextRole($currentRoleId);
$canApprove = $flow->canApprove($user_id, $doc_id);
```

---

### 🔹 Plain PHP (PDO)

```php
use ApprovalFlow\Services\ApprovalFlow;
use ApprovalFlow\Adapters\PdoAdapter;

$pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");
$adapter = new PdoAdapter($pdo);
$flow = new ApprovalFlow($adapter);

if ($flow->canApprove(1, 100)) {
    echo "User can approve document!";
}
```

---

## 🧠 Architecture

- **Core Logic:** `ApprovalFlow` (framework-independent)
- **Adapters:**
  - `LaravelAdapter` — Uses Laravel’s Query Builder (DB Facade)
  - `CodeIgniterAdapter` — Uses CI’s `$this->db` query builder
  - `PdoAdapter` — Uses native PDO
- **Contract:** `ApproverInterface` ensures consistency across adapters

---

## 🧰 Helper Functions

```php
approval_log("Approval started...");
// Output: [ApprovalFlow] 2025-10-13 11:00:00 - Approval started...
```

---

## 🧪 Running Tests

```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```

Sample test (`tests/ApprovalFlowTest.php`) is already included.

---

## 🧱 Folder Structure

```
approval-flow/
│
├── src/
│   ├── Contracts/ApproverInterface.php
│   ├── Services/ApprovalFlow.php
│   ├── Adapters/
│   │   ├── LaravelAdapter.php
│   │   ├── CodeIgniterAdapter.php
│   │   └── PdoAdapter.php
│   └── Helpers/helper.php
│
├── tests/
│   └── ApprovalFlowTest.php
└── composer.json
```

---

## 🪪 License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author

**Md Shahajahan Ali**
📧 [msacse1@gmail.com](mailto:msacse1@gmail.com)
🌐 [GitHub: @shahajahan](https://github.com/shahajahancse)

---

## 🌟 Contributing

Pull requests are welcome!
To contribute:
1. Fork the repository
2. Create your feature branch (`git checkout -b feature/your-feature`)
3. Commit changes and push
4. Submit a Pull Request 🎯

---

## 💡 Future Enhancements

- Approval workflow templates (Leave, Expense, Purchase)
- Event hooks (`onApprove`, `onReject`)
- JSON-based flow configuration
- Role-based escalation and notifications
