//
//  FMGeometry.h
//  FMMapKit
//
//  Created by FengMap on 15/4/28.
//  Copyright (c) 2015年 FengMap. All rights reserved.
//

#import <Foundation/Foundation.h>
#import <UIKit/UIKit.h>

/**
 *	蜂鸟视图点,
 *	该点为地图数据点，
 *	通过地图数据取得
 */

typedef double  FMKDegrees;
typedef int     FMKMapGroupID;
typedef int		FMKMapID;

///蜂鸟投影坐标点
typedef struct FMKMapPoint
{
    FMKDegrees x;
    FMKDegrees y;
}FMKMapPoint;

inline static FMKMapPoint FMKMapPointMake(FMKDegrees x,FMKDegrees y)
{
    FMKMapPoint coord;
    coord.x = x;
    coord.y = y;
    return coord;
}

inline static const FMKMapPoint FMKMapPointZero(void)
{
    return FMKMapPointMake(0, 0);
}

inline static NSString* NSStringFromFMKMapPoint(FMKMapPoint mapPoint)
{
    return [NSString stringWithFormat:@"%lf %lf",mapPoint.x,mapPoint.y];
}

/**
 蜂鸟地理楼层坐标
 */
typedef struct FMKGeoCoord
{    
    FMKMapGroupID  groupID;        //楼层
    FMKMapPoint    mapPoint;   //投影坐标
}FMKGeoCoord;


inline static FMKGeoCoord FMKGeoCoordMake(FMKMapGroupID groupID,FMKMapPoint mapPoint)
{
    FMKGeoCoord geoCoord;
    geoCoord.mapPoint  = mapPoint;
    geoCoord.groupID   = groupID;
    return geoCoord;
}

inline static const FMKGeoCoord FMKGeoCoordZero(void)
{
    return FMKGeoCoordMake(0, FMKMapPointZero());
}

inline static NSString* NSStringFromFMKGeoCoord(FMKGeoCoord geoCoord)
{
    return [NSString stringWithFormat:@"%d %lf %lf",geoCoord.groupID,geoCoord.mapPoint.x,geoCoord.mapPoint.y];
}

typedef struct FMKMapCoord
{
	FMKGeoCoord coord;
	FMKMapID mapID;
	
}FMKMapCoord;

inline static FMKMapCoord FMKMapCoordMake(FMKMapID mapID, FMKGeoCoord coord)
{
	FMKMapCoord mapCoord;
	mapCoord.mapID = mapID;
	mapCoord.coord = coord;
	return mapCoord;
}
inline static NSString * NSStringFromFMKMapCoord(FMKMapCoord mapCoord)
{
	return [NSString stringWithFormat:@"%d %d %lf %lf",mapCoord.mapID,mapCoord.coord.groupID,mapCoord.coord.mapPoint.x,mapCoord.coord.mapPoint.y];
}

/**
 地图缩放范围定义 注意与地图缩放级别范围区别
 */
typedef struct FMKMapScaleRange
{
	float min;
	float max;
	
}FMKMapScaleRange;

inline static FMKMapScaleRange FMKMapScaleRangeMake(float min, float max)
{
	FMKMapScaleRange range;
	range.max = max;
	range.min = min;
	return range;
}

inline static NSString* NSStringFromFMKMapScaleRange(FMKMapScaleRange range)
{
	return [NSString stringWithFormat:@"%lf  %lf",range.min, range.max];
}


/**
 地图缩放级别范围定义 注意与地图缩放范围区别
 */
typedef struct FMKMapZoomLevelRange
{
	int min;
	int max;
	
}FMKMapZoomLevelRange;

inline static FMKMapZoomLevelRange FMKMapZoomLevelRangeMake(int min, int max)
{
	FMKMapZoomLevelRange range;
	range.max = max;
	range.min = min;
	return range;
}

inline static NSString* NSStringFromFMKMapZoomLevelRange(FMKMapZoomLevelRange range)
{
	return [NSString stringWithFormat:@"min:%d  max:%d",range.min, range.max];
}

@interface NSValue (FMKValue)

+ (NSValue *)valueWithFMKMapPoint:(FMKMapPoint)mapPoint;
+ (NSValue *)valueWithFMKGeoCoord:(FMKGeoCoord)geoCoord;

- (FMKMapPoint)FMKMapPointValue;
- (FMKGeoCoord)FMKGeoCoordValue;

@end








