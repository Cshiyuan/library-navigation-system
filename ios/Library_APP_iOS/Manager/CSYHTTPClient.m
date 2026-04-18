//
//  CSYHTTPClient.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/4.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "CSYHTTPClient.h"

//static const NSString* BASE_URL = @"http://119.29.186.160/";
#pragma mark - Constants Definition
#define BASE_URL @"http://119.29.186.160/"


@interface CSYHTTPClient ()
{
    
}
@property (nonatomic, strong) AFHTTPSessionManager *manager;
@end

@implementation CSYHTTPClient

- (instancetype) init
{
    if (self = [super init])
    {
        _manager = [[AFHTTPSessionManager manager] initWithBaseURL:[NSURL URLWithString:BASE_URL]];
        
        _manager.responseSerializer.acceptableContentTypes = nil;//[NSSet setWithObject:@"text/ plain"];
        _manager.securityPolicy = [AFSecurityPolicy defaultPolicy];
        _manager.securityPolicy.allowInvalidCertificates = YES;//忽略https证书
        _manager.securityPolicy.validatesDomainName = NO;//是否验证域名
        
        //请求参数序列化类型
        _manager.requestSerializer = [AFHTTPRequestSerializer serializer];
        
        //响应结果序列化类型
        _manager.responseSerializer = [AFHTTPResponseSerializer serializer];
        _baseURLString = BASE_URL;
    }
    return self;
}


+ (CSYHTTPClient *)defaultClient
{
    static CSYHTTPClient *instance = nil;
    static dispatch_once_t predicate;
    dispatch_once(&predicate, ^{
        instance = [[self alloc] init];
    });
    return instance;
}


#pragma mark - HTTP REQUEST METHODS
- (void) getPath:(NSString *)path  parameters:(NSDictionary *)parameters success:(void (^)(NSURLSessionDataTask *task, id responseObject))success failure:(void (^)(NSURLSessionDataTask *task, NSError *error))failure
{
    NSString *absolutePath = [path hasPrefix:@"http"] ? path : [NSString stringWithFormat:@"%@%@", _baseURLString, path];
    
    [_manager GET:absolutePath parameters:parameters progress:^(NSProgress * _Nonnull downloadProgress) {
        
    } success:^(NSURLSessionDataTask * _Nonnull task, id  _Nullable responseObject) {
        
        NSError *error = nil;
        
        id jsonObj = [NSJSONSerialization JSONObjectWithData:responseObject options:NSJSONReadingAllowFragments error:&error];
        if (nil == jsonObj) {
            //JSON解释错误
            NSLog(@"JSON DECODE ERROR. %@", error);
            LOG_DATA(responseObject);
            
            failure(task, [[NSError alloc] initWithDomain:CSYHttpResponseErrorDomain code:CSYErrorCodeHttpResponseNetworkError userInfo:nil]);
            return ;
        }
        success(task, jsonObj);
        
    } failure:^(NSURLSessionDataTask * _Nullable task, NSError * _Nonnull error) {
        //网络错误
        failure(task,[[NSError alloc] initWithDomain:CSYHttpResponseErrorDomain code:CSYErrorCodeHttpResponseNetworkError userInfo:nil]);
    }];
    
}


- (BOOL) netWorkReachabilityWithURLString:(NSString *) strUrl
{
    __block BOOL netState = NO;
    
    [_manager.reachabilityManager startMonitoring];
    [_manager.reachabilityManager setReachabilityStatusChangeBlock:^(AFNetworkReachabilityStatus status) {
        switch (status) {
            case AFNetworkReachabilityStatusReachableViaWWAN:
            case AFNetworkReachabilityStatusReachableViaWiFi:
                netState = YES;
                break;
            case AFNetworkReachabilityStatusNotReachable:
                netState = NO;
            default:
                break;
        }
    }];
    
    return netState;
}

@end
