```mermaid
erDiagram
users ||--o{ items : "出品"
users ||--o{ orders : "購入"
users ||--o{ likes : "いいね"
users ||--o{ comments : "コメント"
items ||--|| orders : "売却"
items ||--o{ likes : "被いいね"
items ||--o{ comments : "被コメント"
items }o--o{ categories : "所属"
```