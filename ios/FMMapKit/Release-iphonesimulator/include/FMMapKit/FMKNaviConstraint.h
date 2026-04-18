//
//  FMKNaviConstraint.h
//  FMMapKit
//
//  Created by fengmap on 16/7/13.
//  Copyright © 2016年 Fengmap. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "FMKGeometry.h"


/**
 路径约束计算结果类型

 - FMKCONSTRAINT_SUCCESS: 成功
 - FMKCONSTRAINT_FAILED_NO_NAVIDATAS: 失败 无数据
 - FMKCONSTRAINT_FAILED_NO_CONSTRAINT: 失败 无法约束
 - FMKCONSTRAINT_ERROR: 失败 未知错误
 */
typedef NS_ENUM(NSInteger, FMKConstraintType)
{
	FMKCONSTRAINT_SUCCESS = 1,
	FMKCONSTRAINT_FAILED_NO_NAVIDATAS,
	FMKCONSTRAINT_FAILED_NO_CONSTRAINT,
	FMKCONSTRAINT_ERROR
};


/**
 路径约束计算结果
 */
typedef struct FMKNaviConstraintResult
{
	///返回结果类型
	FMKConstraintType type;
	
	/**
	 返回结果下标
	 
	 该下标为路径约束结果点坐标在点集合中所在线段的起点下标
	 */
	int index;
	
	/**
	 定位点与点集合构成路线的偏移量
	 */
	float distance;
	
	/**
	 路径约束计算结果
	 */
	FMKMapPoint mapPoint;
	
}FMKNaviConstraintResult;


@interface FMKNaviConstraint : NSObject
/**
 *  初始化路径约束
 *
 *  @param mapPath 地图数据路径
 *
 *  @return 路径约束对象
 */
- (instancetype)initWithMapPath:(NSString *)mapPath;

/**
 *  更新路径约束所需参数
 *
 *  @param mapPoints 地图坐标点集合
 *  @param groupID   所在楼层ID
 */
- (void)updateNaviConstraintDataWithPoints:(NSArray *)mapPoints
						 groupID:(NSString *)groupID;

/**
 *  路径约束点计算
 *
 *  @param lastMapPoint    上一个地图坐标
 *  @param currentMapPoint 当前地图坐标
 *
 *  @return 路径约束结果
 */
- (FMKNaviConstraintResult)naviConstraintByLastPoint:(FMKMapPoint)lastMapPoint currentMapPoint:(FMKMapPoint)currentMapPoint;

@end
