# Rhinoforum

後端面試前測題

## Rules

- 作答時間為 1 小時
- clone 此專案，並以新建立的 branch 進行作答。
- 繳交方式：以個人帳號建立 repository，在收到題目 3 天內將 repository URL 寄回
- 針對題目若有任何疑問，也可以來信詢問

## Questions

### 簡介
- Rhinoforum 是一個簡易的論壇系統，使用 Laravel 8 進行開發
- 目前只有以下功能
    - 純 API server
    - 使用者（User）和文章（Post）的資料表

### 題目
請按照 [Getting started](#getting-started) 的指示建立好開發環境，並完成以下任務：

#### 一、請實作查詢貼文 API
- caller 可任選以下方式作為搜尋條件：
    - 作者（等於 id）
    - 分類（等於文字）
    - 貼文內容（包含文字）
    - 發布時間（時間 x 和 y 的區間）
- 支援 pagination
    - 可以指定要取得第 n 頁的資料
    - 可以指定每頁 m 筆資料
- 撰寫 feature test
- hint：可在專案中搜尋 `TODO`

#### 二、請說明如何為該 API 進行壓力測試

*請直接在此作答*

### 評分重點
- edge case 的考量
- 執行效率
- 程式架構
- commit 可讀性


## Getting started

### Prerequisites
- 安裝 [docker](https://docker.com/)

### Installation

安裝依賴：

```bash
# clone
git clone https://bitbucket.org/evolutivelabs/rhinoforum.git
cd rhinoforum

# 安裝依賴
docker run -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install
```

本專案使用 [Laravel Sail](https://laravel.com/docs/8.x/sail) 建立開發環境。詳情請參考官方文件。

為 `vendor/bin/sail` 建立 alias 以便使用：

```bash
alias sail='bash vendor/bin/sail'
```

### Setup

啟動開發環境並進行專案初始化：

```bash
# 複製 .env
# DB、 cache 連線參數已按照 docker 環境配置設定好，只需視開發環境調整 `APP_PORT`
cp .env.example .env

# 啟動開發環境
sail up -d

# 產生 app key
sail artisan key:generate

# 準備資料庫
sail artisan migrate
```

## Development

可能會用到的指令：

```bash
# 執行開發環境
sail up -d

# 安裝套件
sail composer require <package_name>

# 執行測試
sail test

# 加上 -v 參數，將 docker network 和 volumn 一併清除
sail down -v
```

原則上 Sail 僅僅是封裝 docker-compose ，並提供使用者 `sail composer` 、 `sail artisan` 、 `sail test` 等捷徑可以存取 container 環境裡的指令。
