# Library Navigation System

> 图书馆室内导航系统 -- 基于 Wi-Fi 指纹定位，提供图书馆内实时导航与图书检索功能。

## 项目结构

```
├── android/   Android 客户端 (Java)
├── ios/       iOS 客户端 (Objective-C)
├── web/       Web 管理后台 (ThinkPHP)
├── api/       后端 API 服务 (PhalApi)
└── docs/      项目文档与数据库设计
```

## 技术栈

| 端 | 技术 |
|---|---|
| Android | Java, Android SDK |
| iOS | Objective-C, CocoaPods |
| Web | PHP, ThinkPHP |
| API | PHP, PhalApi |

---

## Android 客户端

<img src="android/image/%E5%9B%BE%E7%89%87%201.png" width="30%" /> <img src="android/image/%E5%9B%BE%E7%89%87%202.png" width="30%" />

<img src="android/image/%E5%B1%95%E6%9D%BF%E6%9D%90%E6%96%99.jpg" width="60%" />

---

## iOS 客户端

<img src="ios/image/15-21-21.gif" width="30%" />

---

## Web 管理后台

<img src="web/image/D310DAA6-7A12-4EFB-91A3-93D2BFDEDF72.png" width="80%" />

功能模块：

1. **后台登录** -- 用户名密码 + 验证码登录
2. **图书信息管理** -- 查看图书信息（所在书架、是否借出等），支持编辑、删除和搜索
3. **添加图书** -- 附带可拖动缩放的室内地图，辅助编辑图书位置
4. **管理员管理** -- 注册新管理员
5. **个人资料** -- 查看账号信息和登录记录

源码结构：
- `ThinkPHP/` -- ThinkPHP 核心文件
- `Application/Admin/` -- 主模块（Controller / Model / View）
- `Public/` -- 静态资源（css / js / 地图数据 / 图片）

---

## API 服务

基于 [PhalApi](http://www.phalapi.net) (V1.3.4) PHP 轻量级接口框架。

```
api/
├── Config/        配置文件
├── Data/          公共数据
├── Demo/          业务接口（Api / Domain / Model / Tests）
├── Library/       扩展类库
├── LibraryAPI/    项目接口服务
├── PhalApi/       框架核心
├── Public/        对外访问入口
├── SDK/           客户端 SDK 包
└── Runtime/       运行时缓存与日志
```
