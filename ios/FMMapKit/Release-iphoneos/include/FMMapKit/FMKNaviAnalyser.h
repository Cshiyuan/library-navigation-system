//
//  FMNaviAnalyser.h
//  FMMapKit
//
//  Created by FengMap on 15/6/1.
//  Copyright (c) 2015年 FengMap. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "FMKGeometry.h"

@class FMKNaviPredictionSegment;

/**
 *  路径规划类型
 */
typedef NS_ENUM(NSInteger, FMKNaviModule)
{
    /**
     * 最短
     */
    MODULE_SHORTEST = 1,
    
    /**
     * 最优
     */
    MODULE_BEST = 2,
};

/**
 楼层间路径规划方式优先级

 - FMKROUTE_CGP_DEFAULT:        默认 直梯优先
 - FMKROUTE_CGP_ESCALATORFIRST: 扶梯优先
 - FMKROUTE_CGP_STAIRFIRST:     楼梯优先
 - FMKROUTE_CGP_LIFTONLY:       仅直梯
 - FMKROUTE_CGP_ESCALATORONLY:  仅扶梯
 - FMKROUTE_CGP_STAIRONLY:      仅楼梯
 */

typedef NS_ENUM(NSInteger, FMKRouteCrossGroupPriority)
{
	FMKROUTE_CGP_DEFAULT = 0,//LIFT > ESCALATOR > STAIR
	FMKROUTE_CGP_LIFTFIRST,
	FMKROUTE_CGP_ESCALATORFIRST,
	FMKROUTE_CGP_STAIRFIRST,
	FMKROUTE_CGP_LIFTONLY,
	FMKROUTE_CGP_ESCALATORONLY,
	FMKROUTE_CGP_STAIRONLY
};

/**
 路径分析类型设置
 */
typedef struct FMKRouteSetting
{
	/*
	 *	路径经过楼梯优先级选择
	 */
	FMKRouteCrossGroupPriority routeCrossGroupPriority;
	/*
	 *	
	 */
	FMKNaviModule naviModule;
	
}FMKRouteSetting;

/**
 * 路径计算的返回值。
 */
typedef NS_ENUM(int, FMKRouteCalculateResultType)
{
    IROUTE_DATA_LOST = -3,               ///地图数据不存在
    IROUTE_DATABASE_ERROR = -2,          ///数据库出错
    IROUTE_PARAM_ERROR = -1,             ///数据错误
    IROUTE_SUCCESS = 1,                  ///成功
    IROUTE_FAILURE_NO_FMDBKERNEL = 2,    ///与数据无关的错误
    IROUTE_FAILURE_TOO_CLOSE = 3,        ///失败，起点和终点太近
    IROUTE_FAILURE_NO_START = 4,         ///失败，没有起点所在层的数据
    IROUTE_FAILURE_NO_END = 5,           ///失败，没有终点所在层的数据
    IROUTE_FAILURE_NO_STAIR_FLOORS = 6,  ///失败，没有电梯（扶梯）进行跨楼路径规划
    IROUTE_FAILURE_NOTSUPPORT_FLOORS = 7,///失败，不支持跨楼层导航
    IROUTE_FAILED_CANNOT_CALCULATE = 8,  ///不能计算
    IROUTE_SUCCESS_NO_RESULT = 9         ///没有结果
};

/*
 *  路径规划分析
 */
@class FMKNaviResult;

@protocol FMKNaviAnalyserDelegate;

@interface FMKNaviAnalyser : NSObject


/**
 文字导航处理结果 路径规划有结果时有效
 */
@property (nonatomic, readonly) NSArray <FMKNaviPredictionSegment *>* naviDescriptionsData;

/**
 文字导航文字描述 路径规划有结果时有效
 */
@property (nonatomic, readonly) NSArray <NSString *>* naviDescriptions;

/**
 *  通过mapID初始化路径分析
 *	通过该结果初始化路径分析对象时，地图数据路径必须是通过ID下载得到的，否则初始化失败
 *
 *  @param mapID mapID
 *
 *  @return 路径分析对象
 */
- (instancetype)initWithMapID:(NSString *)mapID;

/**
 *  通过地图数据路径初始化路径分析
 *
 *  @param dataPath 地图数据路径
 *
 *  @return 路径分析对象
 */
- (instancetype)initWithMapPath:(NSString *)dataPath;

/**
 *  路径规划分析代理
 */
@property (nonatomic,weak)  id<FMKNaviAnalyserDelegate> delegate;

/**
 *  路径规划分析
 *
 *  @param start           路径规划起点
 *  @param end             路径规划终点
 *  @param routeSetting          路径规划类型
 *
 *  @return 路径规划计算结果
 */
- (FMKRouteCalculateResultType)analyseRouteWithStartCoord:(FMKGeoCoord)start
                                                 endCoord:(FMKGeoCoord)end
                                                     type:(FMKRouteSetting)routeSetting;

/**
 *  路径规划分析
 *
 *  @param start           路径规划起点
 *  @param end             路径规划终点
 *  @param routeSetting          路径规划类型
 *  @param naviResults     路径规划结果，对象为FMKNaviResult型对象
 *
 *  @return 路径规划计算结果
 */
- (FMKRouteCalculateResultType)analyseRouteWithStartCoord:(FMKGeoCoord)start
                                                      end:(FMKGeoCoord)end
                                                     type:(FMKRouteSetting)routeSetting
                                              routeResult:(NSMutableArray **)naviResults;

@end

@protocol FMKNaviAnalyserDelegate <NSObject>

@optional

/**
 *  同层结果计算，路径坐标集合
 *
 *  @param coords 数组中为FMKMapPoint的NSValue类型数据
 */
- (void)getFloorNaviGeoCoords:(NSArray *)coords inFloor:(NSString *)groupID;

/**
 * 同层结果计算，路径长度
 */
- (void)getFloorRouteLength:(double)length;

/**
 * 跨层结果计算，获取经过楼层的id
 */
- (void)getMultiFloorNaviGroupIDs:(NSArray *)gids;

/**
 * 跨层结果计算，获取各层路径的长度
 */
- (void)getMultiFloorRouteLength:(double)length inFloor:(NSString *)groupID;

/**
 *  跨层结果计算，返回路径上的点
 *  @param coords 数组中为FMKMapPoint的NSValue类型数据
 */
- (void)getMultiFloorNaviGeoCoords:(NSArray *)coords inFloor:(NSString *)groupID;

/**
 *  跨层路径总长度
 */
- (void)getMultiFloorTotalLength:(double)length;

@end





